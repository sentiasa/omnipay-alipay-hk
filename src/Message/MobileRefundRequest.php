<?php

namespace Omnipay\AlipayHk\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\AlipayHk\Helper;

/**
 * Class MobileRefundRequest
 *
 * @package Omnipay\AlipayHk\Message
 */
class MobileRefundRequest extends AbstractMobileRequest
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
            "gateway_url"         => $this->getEndpoint('query'),
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
        $fields = [
            'merchant_reference' => $data['merchant_reference']
        ];

        $fields['sign'] = Helper::genHashValue($fields, $data['secret']);

        $response = Helper::sendHttpRequest($data['gateway_url'], $fields);

        $order = [
            'amount'             => $response['amount'],
            'currency'           => $response['currency'],
            'request_reference'  => $response['request_reference'],
            'merchant_reference' => $response['merchant_reference'],
            'status'             => $response['status']
        ];

        $response['is_paid'] = false;
        if ($response['sign'] === Helper::genHashValue($order, $this->getSecret())
            && bccomp($this->getAmount(), $order['amount'], 2) === 0
            && $this->getCurrency() === $order['currency']
            && $this->getMerchantReference() === $order['merchant_reference']
            && $response['status'] === '1'
        ) {
            $response['is_paid'] = true;
        }

        return $this->response = new MobileRefundResponse($this, array_merge($data, $response));
    }
}
