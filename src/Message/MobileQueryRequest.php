<?php

namespace Omnipay\AlipayHk\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\AlipayHk\Helper;

/**
 * Class MobileQueryRequest
 *
 * @package Omnipay\AlipayHk\Message
 */
class MobileQueryRequest extends AbstractMobileRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validate(
            'merchant_reference',
            'secret'
        );

        $data = array(
            "merchant_reference"  => $this->getMerchantReference(),
            "secret"              => $this->getSecret(),
            "gateway_url"         => $this->getEndpoint(),
        );

        return $data;
    }


    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {

        return array_merge($data, (array) $result->$responseNode);
    }
}
