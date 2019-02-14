<?php

namespace Ls\Omni\Helper;

use Magento\Framework\App\Helper\Context;
use \Ls\Omni\Client\Ecommerce\Entity;
use \Ls\Omni\Client\Ecommerce\Operation;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Catalog\Model\ProductFactory;
use Magento\Quote\Model\Quote;
use Magento\CatalogInventory\Model\Stock\StockItemRepository;
use Magento\Framework\Registry;
use \Ls\Core\Model\LSR;
use Magento\Framework\Session\SessionManagerInterface;

/**
 * Class BasketHelper
 * @package Ls\Omni\Helper
 */
class BasketHelper extends \Magento\Framework\App\Helper\AbstractHelper
{
    /** @var Cart $cart */
    public $cart;

    /** @var \Magento\Catalog\Model\ProductRepository $productRepository */
    public $productRepository;

    /**
     * @var \Magento\Checkout\Model\Session\Proxy
     */
    public $checkoutSession;

    /**
     * @var \Magento\Customer\Model\Session\Proxy
     */
    public $customerSession;

    /** @var SearchCriteriaBuilder $searchCriteriaBuilder */
    public $searchCriteriaBuilder;

    /** @var \Magento\ConfigurableProduct\Model\ResourceModel\Product\
     * Type\Configurable $catalogProductTypeConfigurable
     */
    public $catalogProductTypeConfigurable;

    /** @var ProductFactory $productFactory */
    public $productFactory;

    /** @var StockItemRepository $stockItemRepository */
    public $stockItemRepository;

    /** @var ItemHelper $itemHelper */
    public $itemHelper;

    /** @var Registry $registry */
    public $registry;

    /** @var null|Entity\BasketCalcResponse $oneListCalculation */
    public $oneListCalculation = null;

    /** @var null|string */
    public $store_id = null;

    /** @var  LSR $lsr */
    public $lsr;

    /** @var array */
    public $basketDataResponse;

    /**
     * @var SessionManagerInterface
     */
    public $session;

    /**
     * BasketHelper constructor.
     * @param Context $context
     * @param Cart $cart
     * @param ProductRepository $productRepository
     * @param \Magento\Checkout\Model\Session\Proxy $checkoutSession
     * @param \Magento\Customer\Model\Session\Proxy $customerSession
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable $catalogProductTypeConfigurable
     * @param ProductFactory $productFactory
     * @param StockItemRepository $stockItemRepository
     * @param ItemHelper $itemHelper
     * @param Registry $registry
     * @param LSR $Lsr
     * @param SessionManagerInterface $session
     */
    public function __construct(
        Context $context,
        Cart $cart,
        ProductRepository $productRepository,
        \Magento\Checkout\Model\Session\Proxy $checkoutSession,
        \Magento\Customer\Model\Session\Proxy $customerSession,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable $catalogProductTypeConfigurable,
        ProductFactory $productFactory,
        StockItemRepository $stockItemRepository,
        ItemHelper $itemHelper,
        Registry $registry,
        LSR $Lsr,
        SessionManagerInterface $session
    ) {
        parent::__construct($context);
        $this->cart = $cart;
        $this->productRepository = $productRepository;
        $this->checkoutSession = $checkoutSession;
        $this->customerSession = $customerSession;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->catalogProductTypeConfigurable = $catalogProductTypeConfigurable;
        $this->productFactory = $productFactory;
        $this->stockItemRepository = $stockItemRepository;
        $this->itemHelper = $itemHelper;
        $this->registry = $registry;
        $this->lsr = $Lsr;
        $this->session = $session;
    }

    /**
     * Compared a OneList with a quote and returns an array which contains
     * the items present only in the quote and only in the OneList (basket)
     * @param Entity\OneList $list
     * @param Quote $quote
     * @return array
     */
    public function compare(Entity\OneList $oneList, Quote $quote)
    {
        /** @var Entity\OneListItem[] $onlyInOneList */
        /** @var Entity\OneListItem[] $onlyInQuote */
        $onlyInOneList = [];
        $onlyInQuote = [];

        /** @var \Magento\Quote\Model\Quote\Item[] $quoteItems */
        $cache = [];
        $quoteItems = $quote->getAllVisibleItems();

        /** @var Entity\OneListItem[] $oneListItems */
        $oneListItems = !($oneList->getItems()->getOneListItem()==null)
            ? $oneList->getItems()->getOneListItem()
            : [];

        foreach ($oneListItems as $oneListItem) {
            $found = false;

            foreach ($quoteItems as $quoteItem) {
                $isConfigurable = $quoteItem->getProductType()
                    == \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE;
                if (isset($cache[$quoteItem->getId()]) || $isConfigurable) {
                    continue;
                }
                // @codingStandardsIgnoreStart
                $productLsrId = $this->productFactory->create()
                    ->load($quoteItem->getProduct()->getId())
                    ->getData('lsr_id');
                // @codingStandardsIgnoreEnd
                $quote_has_item = $productLsrId == $oneListItem->getItem()->getId();
                $qi_qty = $quoteItem->getData('qty');
                $item_qty = (int)($oneListItem->getQuantity());
                $match = $quote_has_item && ($qi_qty == $item_qty);

                if ($match) {
                    $cache[$quoteItem->getId()] = $found = true;
                    break;
                }
            }

            // if found is still false, the item is not presend in the quote
            if (!$found) {
                $onlyInOneList[] = $oneListItem;
            }
        }

        foreach ($quoteItems as $quoteItem) {
            $isConfigurable = $quoteItem->getProductType()
                == \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE;

            // if the item is in the cache, it is present in the oneList and the quote
            if (isset($cache[$quoteItem->getId()]) || $isConfigurable) {
                continue;
            }
            $onlyInQuote[] = $quoteItem;
        }

        return [$onlyInQuote, $onlyInOneList];
    }

    /**
     * @param Quote $quote
     * @param Entity\OneList $oneList
     * @return Entity\OneList
     */
    public function setOneListQuote(Quote $quote, Entity\OneList $oneList)
    {

        /** @var \Magento\Quote\Model\Quote\Item[] $quoteItems */
        $quoteItems = $quote->getAllVisibleItems();

        /** @var Entity\ArrayOfOneListItem $items */
        // @codingStandardsIgnoreLine
        $items = new Entity\ArrayOfOneListItem();

        $itemsArray = [];

        foreach ($quoteItems as $quoteItem) {
            // initialize the default null value
            $variant = $barcode = null;

            $sku = $quoteItem->getSku();

            $searchCriteria = $this->searchCriteriaBuilder->addFilter('sku', $sku, 'eq')->create();

            $productList = $this->productRepository->getList($searchCriteria)->getItems();

            /** @var \Magento\Catalog\Model\Product\Interceptor $product */
            $product = array_pop($productList);

            $barcode = $product->getData('barcode');

            $parts = explode('-', $sku);
            // first element is lsr_id
            $lsr_id = array_shift($parts);
            // second element, if it exists, is variant id
            // @codingStandardsIgnoreLine
            $variant_id = count($parts) ? array_shift($parts) : null;

            /** @var \Ls\Omni\Client\Ecommerce\Entity\LoyItem $item */
            $item = $this->itemHelper->get($lsr_id);

            if (!($variant_id==null)) {
                /** @var Entity\VariantRegistration|null $variant */
                $variant = $this->itemHelper->getItemVariant($item, $variant_id);
            }
            /** @var Entity\UnitOfMeasure|null $uom */
            $uom = $this->itemHelper->uom($item);
            // @codingStandardsIgnoreLine
            $list_item = (new Entity\OneListItem())
                ->setQuantity($quoteItem->getData('qty'))
                ->setItem($item)
                ->setBarcodeId($barcode)
                ->setVariantReg($variant)
                ->setUnitOfMeasure($uom);

            $itemsArray[] = $list_item;
        }
        $items->setOneListItem($itemsArray);

        $oneList->setItems($items)
            ->setPublishedOffers($this->_offers());
        return $oneList;
    }

    /**
     * @return Entity\ArrayOfOneListPublishedOffer
     */
    private function _offers()
    {
        // @codingStandardsIgnoreLine
        $offers = new Entity\ArrayOfOneListPublishedOffer();
        return $offers;
    }

    /**
     * @param Entity\OneList $oneList
     * @return bool
     * @throws \Ls\Omni\Exception\InvalidEnumException
     */
    public function delete(Entity\OneList $oneList)
    {

        /** @var Entity\OneListDeleteById $entity */
        // @codingStandardsIgnoreLine
        $entity = new Entity\OneListDeleteById();

        $entity->setOneListId($oneList->getId());
        // @codingStandardsIgnoreLine
        $request = new Operation\OneListDeleteById();

        /** @var  Entity\OneListDeleteByIdResponse $response */
        $response = $request->execute($entity);

        return $response ? $response->getOneListDeleteByIdResult() : false;
    }

    /**
     * @param Entity\OneList $oneList
     * @return Entity\BasketCalcResponse|null
     * @throws \Ls\Omni\Exception\InvalidEnumException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    // @codingStandardsIgnoreLine
    public function update(Entity\OneList $oneList)
    {
        $check_inventory = false;
        $update_inventory = false;

        if ($check_inventory) {
            /** @var Entity\ArrayOfOrderLineAvailability $availability */
            $availability = $this->availability($oneList);
            /** @var OrderLineAvailability[] $availabilityLines */
            if ($availability && $availabilityLines = $availability->getOrderLineAvailability()) {
                $quote = $this->checkoutSession->getQuote();
                /** @var \Magento\Quote\Model\Quote\Item[] $quoteItems */
                $quoteItems = $quote->getAllVisibleItems();

                foreach ($availabilityLines as $availabilityLine) {
                    $productLsrId = $availabilityLine->getItemId();
                    if ($availabilityLine->getVariantId() !== "") {
                        # build LSR Id
                        $productLsrId = join(
                            '-',
                            [$availabilityLine->getItemId(), $availabilityLine->getVariantId()]
                        );
                    }

                    $stock = (int)($availabilityLine->getQuantity());
                    // @codingStandardsIgnoreStart
                    $searchCriteria = $this->searchCriteriaBuilder->addFilter('lsr_id', $productLsrId, 'like')->create();
                    // @codingStandardsIgnoreEnd
                    $productList = $this->productRepository->getList($searchCriteria);

                    /** @var \Magento\Catalog\Model\Product $product */
                    $product = $productList[0];

                    if ($product->getId()) {
                        $stockItem = $this->stockItemRepository->get($product->getId());

                        if (!$stockItem->getId()) {
                            $stockItem->setData('product_id', $product->getId());
                            $stockItem->setData('stock_id', 1);
                        }

                        $isInStock = $stock > 0 ? 1 : 0;
                        $stockItem
                            ->setData('is_in_stock', $isInStock)
                            ->setData('manage_stock', 0)
                            ->setData('qty', $stock);
                        // @codingStandardsIgnoreLine
                        $stockItem->save();

                        if (!$isInStock && $update_inventory) {

                            /** @var \Magento\Quote\Model\Quote\Item $quoteItem */
                            foreach ($quoteItems as $quoteItem) {
                                $isConfigurable = $quoteItem->getData('product_type') ==
                                    \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE;
                                if ($isConfigurable) {
                                    /** @var Quote\Item $childQuoteItem */ // not sure
                                    $childQuoteItem = array_pop($quoteItem->getChildren());
                                    if ($product->getId() == $childQuoteItem->getProduct()->getId()) {
                                        $this->cart->removeItem($quoteItem->getData('item_id'));
                                        // check if this is necessary
                                        // @codingStandardsIgnoreLine
                                        $this->cart->save();
                                    }
                                } else {
                                    if ($product->getId() == $quoteItem->getProduct()->getId()) {
                                        $this->cart->removeItem($quoteItem->getData('item_id'));
                                        // check if this is necessary
                                        // @codingStandardsIgnoreLine
                                        $this->cart->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->saveToOmni($oneList);
        $basketData = $this->calculate($oneList);
        $this->setOneListCalculation($basketData);
        if (isset($basketData)) {
            $this->unSetBasketSessionValue();
            $this->setBasketSessionValue($basketData);
        }
        return $basketData;
    }

    /**
     * @param Entity\OneList $oneList
     * @return bool|Entity\ArrayOfOrderLineAvailability|Entity\OrderAvailabilityCheckResponse|\Ls\Omni\Client\ResponseInterface
     * @throws \Ls\Omni\Exception\InvalidEnumException
     */
    public function availability(Entity\OneList $oneList)
    {
        $oneListItems = $oneList->getItems();
        $response = false;

        if (!($oneListItems->getOneListItem()==null)) {
            $array = [];

            $count = 1;
            /** @var Entity\OneListItem $listItem */

            foreach ($oneListItems->getOneListItem() as $listItem) {
                $variant = $listItem->getVariant();
                $uom = !($listItem->getUom()==null) ? $listItem->getUom()[0]->getId() : null;
                // @codingStandardsIgnoreLine
                $line = (new Entity\OrderLineAvailability())
                    ->setItemId($listItem->getItem()->getId())
                    ->setLineType(Entity\Enum\LineType::ITEM)
                    ->setUomId($uom)
                    ->setLineNumber($count++)
                    ->setQuantity($listItem->getQuantity())
                    ->setVariantId(($variant==null) ? null : $variant->getId());
                $array[] = $line;
                unset($line);
            }
            // @codingStandardsIgnoreStart
            $lines = new Entity\ArrayOfOrderLineAvailability();
            $lines->setOrderLineAvailability($array);

            $cardId = $this->customerSession->getData(LSR::SESSION_CUSTOMER_CARDID);

            $request = (new Entity\OrderAvailabilityRequest())
                ->setStoreId($this->getDefaultWebStore())
                ->setCardId($cardId)
                ->setSourceType(Entity\Enum\SourceType::STANDARD)
                ->setItemNumberType(Entity\Enum\ItemNumberType::ITEM_NO)
                ->setOrderLineAvailabilityRequests($lines);
            $entity = new Entity\OrderAvailabilityCheck();
            $entity->setRequest($request);
            $operation = new Operation\OrderAvailabilityCheck();
            // @codingStandardsIgnoreEnd
            $response = $operation->execute($entity);
        }

        return $response ? $response->getOrderAvailabilityCheckResult() : $response;
    }

    /**
     * @return null|string
     */
    public function getDefaultWebStore()
    {
        if ($this->store_id==null) {
            $this->store_id = $this->lsr->getDefaultWebStore();
        }
        return $this->store_id;
    }

    /**
     * @param Entity\OneList $list
     * @return bool|Entity\OneList
     */
    public function saveToOmni(Entity\OneList $list)
    {

        /** @var Operation\OneListSave $operation */
        // @codingStandardsIgnoreLine
        $operation = new Operation\OneListSave();

        $list->setStoreId($this->getDefaultWebStore());

        /** @var Entity\OneListSave $request */
        // @codingStandardsIgnoreLine
        $request = (new Entity\OneListSave())
            ->setOneList($list)
            ->setCalculate(true);

        /** @var Entity\OneListSaveResponse $response */
        $response = $operation->execute($request);
        if ($response) {
            $this->customerSession->setData(LSR::SESSION_CART_ONELIST, $response->getOneListSaveResult());
            return $response->getOneListSaveResult();
        }
        return false;
    }

    /**
     * @param Entity\OneList $oneList
     * @return Entity\BasketCalcResponse|null
     * @throws \Ls\Omni\Exception\InvalidEnumException
     */
    // @codingStandardsIgnoreLine
    public function calculate(Entity\OneList $oneList)
    {
        // @codingStandardsIgnoreLine
        //TODO check if this is something needs to be configure from Admin panel or on shopping cart page.
        $shipmentFeeId = 66010;

        $storeId = $this->getDefaultWebStore();

        $contactId = $this->customerSession->getData(LSR::SESSION_CUSTOMER_LSRID);
        $cardId = $this->customerSession->getData(LSR::SESSION_CUSTOMER_CARDID);

        /** @var Entity\ArrayOfOneListItem $oneListItems */
        $oneListItems = $oneList->getItems();

        /** @var Entity\BasketCalcResponse $response */
        $response = false;

        if (!($oneListItems->getOneListItem()==null)) {
            $array = [];
            $n = 1;

            /** @var Entity\OneListItem || Entity\OneListItem[] $listItem */
            $listItems = $oneListItems->getOneListItem();

            if (!is_array($listItems) and $listItems instanceof Entity\OneListItem) {
                $listItem = $listItems;

                /** @var Entity\LoyItem $item */
                $item = $listItem->getItem();

                /** @var Entity\UnitOfMeasure $uom */
                $uom = $listItem->getUnitOfMeasure();
                // @codingStandardsIgnoreLine
                $line = (new Entity\BasketCalcLineRequest())
                    ->setLineNumber($n++)
                    ->setItemId($item->getId())
                    ->setQuantity($listItem->getQuantity())
                    ->setUomId(!($uom==null) ? $uom->getId() : null);

                if (!($listItem->getVariantReg()==null)) {
                    $line->setVariantId($listItem->getVariantReg()->getId());
                }
                $coupon = $this->getCouponCode();
                if (!($coupon==null) and $coupon != 0) {
                    $line->setCouponCode($coupon);
                }

                $array[] = $line;
                unset($line);
            } elseif (is_array($listItems)) {

                /** @var Entity\OneListItem $listItem */
                foreach ($oneListItems->getOneListItem() as $listItem) {

                    /** @var Entity\LoyItem $item */
                    $item = $listItem->getItem();

                    /** @var Entity\UnitOfMeasure $uom */
                    $uom = $listItem->getUnitOfMeasure();
                    // @codingStandardsIgnoreStart
                    $line = (new Entity\BasketCalcLineRequest())
                        ->setLineNumber($n++)
                        ->setItemId($item->getId())
                        ->setQuantity($listItem->getQuantity())
                        ->setUomId(!is_null($uom) ? $uom->getId() : null);
                    // @codingStandardsIgnoreEnd
                    if (!($listItem->getVariantReg()==null)) {
                        $line->setVariantId($listItem->getVariantReg()->getId());
                    }
                    $coupon = $this->getCouponCode();
                    if (!($coupon==null) and $coupon!=0) {
                        $line->setCouponCode($coupon);
                    }

                    $array[] = $line;
                    unset($line);
                }
            }

            /** @var \Magento\Quote\Model\Quote $quote */
            $quote = $this->checkoutSession->getQuote();

            /** @var \Magento\Quote\Model\Quote\Address $shippingAddress */
            $shippingAddress = $quote->getShippingAddress();

            $shippingAmount = $shippingAddress->getShippingAmount();
            // @codingStandardsIgnoreStart
            //if (!is_null($shippingAmount)) {
            // This condition will never work on Cart unless the customer go through with checkout process
                $line = (new Entity\BasketCalcLineRequest())
                    ->setLineNumber($n++)
                    ->setItemId($shipmentFeeId)
                    ->setQuantity(1)
                    ->setUomId("PCS");
                $array[] = $line;
                unset($line);
            //}

            /** @var  Entity\ArrayOfBasketCalcLineRequest $lineRequest */
            // @codingStandardsIgnoreStart
            $lineRequest = new Entity\ArrayOfBasketCalcLineRequest();

            $lineRequest->setBasketCalcLineRequest($array);

            /** @var Entity\BasketCalcRequest $basketCalcRequest */
            $basketCalcRequest = (new Entity\BasketCalcRequest())
                ->setContactId($contactId)
                ->setCardId($cardId)
                ->setCalcType(Entity\Enum\BasketCalcType::NONE)
                ->setBasketCalcLineRequests($lineRequest)
                ->setStoreId($storeId);


            //$basketCalcRequest->setId($oneList->getId());

            /** @var Entity\BasketCalc $entity */
            $entity = new Entity\BasketCalc();

            $entity->setBasketRequest($basketCalcRequest);

            $request = new Operation\BasketCalc();

            // @codingStandardsIgnoreEnd

            /** @var  Entity\BasketCalcResponse $response */
            $response = $request->execute($entity);
        }
        if (($response==null)) {
            // @codingStandardsIgnoreLine
            return new Entity\BasketCalcResponse();
        }
        if (property_exists($response, "BasketCalcResult")) {
            // access inner object and return it
            // @codingStandardsIgnoreLine
            $this->setOneListCalculation($response->BasketCalcResult);
            return $response->BasketCalcResult;
        }
        $this->setOneListCalculation($response);
        return $response;
    }

    /**
     * @return String
     */
    public function getCouponCode()
    {
        $quote = $this->checkoutSession->getQuote();
        $quoteCoupon = $quote->getCouponCode();
        if (!($quoteCoupon==null)) {
            return $quoteCoupon;
        }
        return null;
    }

    /**
     * TODO in next release.
     * Load Shipment Fee Product
     *
     */
    // @codingStandardsIgnoreLine
    public function getShipmentFeeProduct()
    {
    }

    /**
     * @return mixed
     * @throws \Ls\Omni\Exception\InvalidEnumException
     */
    public function getOneListCalculation()
    {
        // @codingStandardsIgnoreStart
        $oneListCalc = $this->checkoutSession->getOneListCalculation();
        if ($oneListCalc==null) {
            $this->calculate(
                $this->get()
            );
            // calculate updates the session, so we fetch again
            return $this->checkoutSession->getOneListCalculation();
            // @codingStandardsIgnoreEnd
        }
        return $oneListCalc;
    }

    /**
     * @param Entity\BasketCalcResponse|null $calculation
     */
    public function setOneListCalculation($calculation)
    {
        $this->checkoutSession->setOneListCalculation($calculation);
    }

    /**
     * @return array|bool|Entity\OneList|Entity\OneList[]|mixed|null
     * @throws \Ls\Omni\Exception\InvalidEnumException
     */
    // @codingStandardsIgnoreLine
    public function get()
    {
        /** @var Entity\OneList $list */
        $list = null;

        //check if onelist is created and stored in session. if it is, than return it.
        if ($this->customerSession->getData(LSR::SESSION_CART_ONELIST)) {
            return $this->customerSession->getData(LSR::SESSION_CART_ONELIST);
        }

        /** @var Entity\MemberContact $loginContact */
        // For logged in users check if onelist is already stored in registry.
        if ($loginContact = $this->registry->registry(LSR::REGISTRY_LOYALTY_LOGINRESULT)) {
            try {
                if ($loginContact->getBasket() instanceof Entity\OneList) {
                        $this->customerSession->setData(LSR::SESSION_CART_ONELIST, $loginContact->getBasket());
                        return $loginContact->getBasket();
                } else {
                    if ($loginContact->getBasket() instanceof Entity\ArrayOfOneList) {
                        foreach ($loginContact->getBasket()->getIterator() as $list) {
                            // @codingStandardsIgnoreLine
                            $list->getListType() == Entity\Enum\ListType::BASKET;
                            if ($list->getIsDefaultList()) {
                                $this->customerSession->setData(LSR::SESSION_CART_ONELIST, $list);
                                return $list;
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                $this->_logger->critical($e);
            }
        }

        /** If no list found from customer session or registered user then get from omni */
        if ($list==null) {
            return $this->fetchFromOmni();
        }

        return null;
    }

    /**
     * @return array|bool|Entity\OneList|Entity\OneList[]|mixed
     * @throws \Ls\Omni\Exception\InvalidEnumException
     */
    public function fetchFromOmni()
    {

        /** Handling the guest user too */
        $contactId = (!($this->customerSession->getData(LSR::SESSION_CUSTOMER_LSRID)==null) ?
            $this->customerSession->getData(LSR::SESSION_CUSTOMER_LSRID) : '');
        // if guest, then empty cardid
        $cardId = (!($this->customerSession->getData(LSR::SESSION_CUSTOMER_CARDID)==null)
            ? $this->customerSession->getData(LSR::SESSION_CUSTOMER_CARDID) : '');

        $store_id = $this->getDefaultWebStore();

        /**
         * If its a logged in user then we need to fetch already created one list.
         */

        if ($contactId != '') {
            /** @var Operation\OneListGetByContactId $request */
            // @codingStandardsIgnoreLine
            $request = new Operation\OneListGetByContactId();

            /** @var Entity\OneListGetByContactId $entity */
            // @codingStandardsIgnoreLine
            $entity = new Entity\OneListGetByContactId();

            $entity->setContactId($contactId)
                ->setListType(Entity\Enum\ListType::BASKET)
                ->setIncludeLines(true);

            /** @var Entity\OneListGetByContactIdResponse $response */
            $response = $request->execute($entity);

            $lists = $response->getOneListGetByContactIdResult()->getOneList();
            // if we have a list or an array, return it
            if (!empty($lists)) {
                if ($lists instanceof Entity\OneList) {
                    return $lists;
                } elseif (is_array($lists)) {
                    # return first list
                    return array_pop($lists);
                }
            }
        }

        /**
         * only those users who either does not have onelist created or
         * is guest user will come up here so for them lets create a new one.
         * for those lets create new list with no items and the existing offers and coupons
         */

        /** @var Entity\OneList $list */
        // @codingStandardsIgnoreStart
        $list = (new Entity\OneList())
            ->setContactId($contactId)
            ->setCardId($cardId)
            ->setDescription('OneList Magento')
            ->setIsDefaultList(true)
            ->setListType(Entity\Enum\ListType::BASKET)
            ->setItems(new Entity\ArrayOfOneListItem())
            ->setPublishedOffers($this->_offers())
            ->setStoreId($store_id);
        return $this->saveToOmni($list);
        // @codingStandardsIgnoreEnd
    }

    /**
     * Unset onelist calculation from session.
     */
    public function unSetOneListCalculation()
    {
        $this->checkoutSession->unsOneListCalculation();
    }

    /**
     * @param $couponCode
     * @throws \Exception
     * @throws \Ls\Omni\Exception\InvalidEnumException
     */
    public function setCouponCode($couponCode)
    {
        $quote = $this->checkoutSession->getQuote();
        $quote->setCouponCode($couponCode);
        $quote->save();
        // update BasketCalculation with new coupon
        $this->calculate(
            $this->get()
        );
    }

    /**
     * Set Basket Session Data
     * @param $value
     */
    public function setBasketSessionValue($value)
    {
        $this->checkoutSession->setBasketdata($value);
    }

    /**
     * Get Basket Session Data
     * @return mixed
     */
    public function getBasketSessionValue()
    {
        return $this->checkoutSession->getBasketdata();
    }

    /**
     * Unset Basket Session Data
     * @return mixed
     */
    public function unSetBasketSessionValue()
    {
        return $this->checkoutSession->unsBasketdata();
    }
}
