<?php

namespace Omnipay\AlipayHk\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\AlipayHk\Helper;

/**
 * Class MobileCompletePurchaseRequest
 *
 * @package Omnipay\AlipayHk\Message
 */
class MobileCompletePurchaseRequest extends AbstractMobileRequest
{
    public function getData()
    {
        return $this->getRequestParams();
    }


    public function setRequestParams($value)
    {
        $this->setParameter('request_params', $value);
    }


    public function getRequestParams()
    {
        return $this->getParameter('request_params');
    }


    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $fields = [
            'amount'             => $data['amount'],
            'currency'           => $data['currency'],
            'request_reference'  => $data['request_reference'],
            'merchant_reference' => $data['merchant_reference'],
            'status'             => $data['status']
        ];

        $data['is_paid'] = false;
        if ($data['sign'] === Helper::genHashValue($fields, $this->getSecret())
            && bccomp($this->getAmount(), $fields['amount'], 2) === 0
            && $this->getCurrency() === $fields['currency']
            && $this->getMerchantReference() === $fields['merchant_reference']
            && $data['status'] === '1'
        ) {
            $data['is_paid'] = true;
        }

        return $this->response = new MobileCompletePurchaseResponse($this, $data);
    }
}
