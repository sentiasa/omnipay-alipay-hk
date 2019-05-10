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
        $order = [
            'merchant_reference' => $this->getMerchantReference(),
            'currency'           => $this->getCurrency(),
            'amount'             => $this->getAmount()
        ];

        $secret = $this->getSecret();

        $fields = [
            'amount'             => $data['amount'],
            'currency'           => $data['currency'],
            'request_reference'  => $data['request_reference'],
            'merchant_reference' => $data['merchant_reference'],
            'status'             => $data['status']
        ];

        $sign = $data['sign'];

        ksort($fields);

        $data['is_paid'] = false;
        if ($sign === hash('SHA512', http_build_query($fields) . $secret)
            && bccomp($order['amount'], $fields['amount'], 2) === 0
            && $order['currency'] === $fields['currency']
            && $order['merchant_reference'] === $fields['merchant_reference']
            && $data['status'] === '1'
        ) {
            $data['is_paid'] = true;
        }

        return $this->response = new MobileCompletePurchaseResponse($this, $data);
    }
}
