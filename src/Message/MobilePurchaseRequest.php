<?php

namespace Omnipay\AlipayHk\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\AlipayHk\Helper;

class MobilePurchaseRequest extends AbstractMobileRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validateData();

        $data = array(
            "merchant_reference"  => $this->getMerchantReference(),
            "currency"            => $this->getCurrency(),
            "amount"              => $this->getAmount(),
            "customer_ip"         => $this->getCustomerIp(),
            "customer_first_name" => $this->getCustomerFirstName(),
            "customer_last_name"  => $this->getCustomerLastName(),
            "customer_phone"      => $this->getCustomerPhone(),
            "customer_email"      => $this->getCustomerEmail(),
            "return_url"          => $this->getReturnUrl(),
            "secret"              => $this->getSecret(),
            "gateway_url"         => $this->getEndpoint(),
        );

        return $data;
    }


    private function validateData()
    {
        $this->validate(
            'merchant_reference',
            'currency',
            'amount',
            'customer_ip',
            'customer_first_name',
            'customer_last_name',
            'customer_phone',
            'customer_email',
            'return_url',
            'secret'
        );
    }


    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new MobilePurchaseResponse($this, $data);
    }
}
