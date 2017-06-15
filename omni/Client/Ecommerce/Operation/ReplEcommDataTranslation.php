<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Operation;

use Ls\Omni\Client\IRequest;
use Ls\Omni\Client\IResponse;
use Ls\Omni\Client\AbstractOperation;
use Ls\Omni\Service\Service as OmniService;
use Ls\Omni\Service\ServiceType;
use Ls\Omni\Service\Soap\Client as OmniClient;
use Ls\Omni\Client\Ecommerce\ClassMap;
use Ls\Omni\Client\Ecommerce\Entity\ReplEcommDataTranslation as ReplEcommDataTranslationRequest;
use Ls\Omni\Client\Ecommerce\Entity\ReplEcommDataTranslationResponse as ReplEcommDataTranslationResponse;

class ReplEcommDataTranslation extends AbstractOperation
{

    const OPERATION_NAME = 'REPL_ECOMM_DATA_TRANSLATION';

    const SERVICE_TYPE = 'ecommerce';

    /**
     * @property OmniClient $client
     */
    public $client = null;

    /**
     * @property ReplEcommDataTranslationRequest $request
     */
    private $request = null;

    /**
     * @property ReplEcommDataTranslationResponse $response
     */
    private $response = null;

    /**
     * @property ReplEcommDataTranslationRequest $request_xml
     */
    private $request_xml = null;

    /**
     * @property ReplEcommDataTranslationResponse $response_xml
     */
    private $response_xml = null;

    /**
     * @property mixed $error
     */
    private $error = null;

    /**
     * @param ServiceType $service_type
     */
    public function __construct()
    {
        $service_type = new ServiceType( self::SERVICE_TYPE );
        parent::__construct( $service_type );
        $url = OmniService::getUrl( $service_type ); 
        $this->client = new OmniClient( $url, $service_type );
        $this->client->setClassmap( $this->getClassMap() );
    }

    /**
     * @param ReplEcommDataTranslationRequest $request
     * @return IResponse|ReplEcommDataTranslationResponse
     */
    public function execute(IRequest $request = null)
    {
        if ( !is_null( $request ) ) {
            $this->setRequest( $request );
        }
        return $this->makeRequest( 'ReplEcommDataTranslation' );
    }

    /**
     * @return ReplEcommDataTranslationRequest
     */
    public function & getOperationInput()
    {
        if ( is_null( $this->request ) ) {
            $this->request = new ReplEcommDataTranslationRequest();
        }
        return $this->request;
    }

    /**
     * @return array
     */
    public function getClassMap()
    {
        return ClassMap::getClassMap();
    }

    protected function isTokenized()
    {
        return FALSE;
    }

    /**
     * @param OmniClient $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return OmniClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ReplEcommDataTranslationRequest $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return ReplEcommDataTranslationRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param ReplEcommDataTranslationResponse $response
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return ReplEcommDataTranslationResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ReplEcommDataTranslationRequest $request_xml
     * @return $this
     */
    public function setRequestXml($request_xml)
    {
        $this->request_xml = $request_xml;
        return $this;
    }

    /**
     * @return ReplEcommDataTranslationRequest
     */
    public function getRequestXml()
    {
        return $this->request_xml;
    }

    /**
     * @param ReplEcommDataTranslationResponse $response_xml
     * @return $this
     */
    public function setResponseXml($response_xml)
    {
        $this->response_xml = $response_xml;
        return $this;
    }

    /**
     * @return ReplEcommDataTranslationResponse
     */
    public function getResponseXml()
    {
        return $this->response_xml;
    }

    /**
     * @param mixed $error
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }


}

