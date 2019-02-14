<?php

namespace Ls\Omni\Service\Soap;

use DOMDocument;
use \Ls\Omni\Service\Metadata;
use \Ls\Omni\Service\ServiceType;
use Zend\Http\ClientStatic;
use Zend\Soap\Client as ZendSoapClient;
use Zend\Uri\Uri;

/**
 * Class Client
 * @package Ls\Omni\Service\Soap
 */
class Client extends ZendSoapClient
{
    /** @var Uri */
    public $URL;
    /** @var  ServiceType */
    public $type;
    /** @var array */
    public $soap_options = ['soap_version' => SOAP_1_1];

    /**
     * Client constructor.
     * @param Uri $uri
     * @param ServiceType $type
     */
    public function __construct(Uri $uri, ServiceType $type)
    {

        parent::__construct($uri->toString(), array_merge($this->soap_options));

        $this->URL = $uri;
        $this->type = $type;
    }

    /**
     * @return DOMDocument
     */
    public function getWsdlXml()
    {

        $response = ClientStatic::get($this->URL);
        // @codingStandardsIgnoreLine
        $xml = new DomDocument('1.0');
        $xml->loadXML($response->getBody());
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;

        return $xml;
    }

    /**
     * @return ServiceType
     */
    public function getServiceType()
    {
        return $this->type;
    }

    /**
     * @param bool $with_replication
     *
     * @return Metadata
     */
    public function getMetadata($with_replication = false)
    {
        // @codingStandardsIgnoreLine
        return new Metadata($this, $with_replication);
    }
}
