<?php

namespace Omnipay\AlipayHk\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\AlipayHk\Helper;

/**
 * Class AbstractMobileRequest
 *
 * @package Omnipay\AlipayHk\Message
 */
abstract class AbstractMobileRequest extends AbstractRequest
{
    protected $paymentEndpoint = 'https://payment.pa-sys.com/';
    protected $gatewayEndpoint = 'https://gateway.pa-sys.com/';

    public function getEndpoint($transaction_request)
    {
        if ($transaction_request == 'pay') {
            return $this->paymentEndpoint . 'app/page/' . $this->getMerchantToken();
        }

        if ($transaction_request == 'query') {
            return $this->gatewayEndpoint . $this->getMerchantToken() . '/payment/query';
        }

        if ($transaction_request == 'refund') {
            return $this->gatewayEndpoint . $this->getMerchantToken() . 'payout/request';
        }

        if ($transaction_request == 'refund_query') {
            return $this->gatewayEndpoint . $this->getMerchantToken() . 'payout/query';
        }
    }


    public function getMerchantToken()
    {
        return $this->getParameter('merchant_token');
    }

    public function setMerchantToken($value)
    {
        return $this->setParameter('merchant_token', $value);
    }


    public function getMerchantReference()
    {
        return $this->getParameter('merchant_reference');
    }

    public function setMerchantReference($value)
    {
        return $this->setParameter('merchant_reference', $value);
    }


    public function getCurrency()
    {
        return strtoupper($this->getParameter('currency'));
    }

    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }


    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }


    public function getReturnUrl()
    {
        return $this->getParameter('return_url');
    }

    public function setReturnUrl($value)
    {
        return $this->setParameter('return_url', $value);
    }


    public function getCustomerIp()
    {
        return $this->getParameter('customer_ip');
    }

    public function setCustomerIp($value)
    {
        return $this->setParameter('customer_ip', $value);
    }


    public function getCustomerFirstName()
    {
        return $this->getParameter('customer_first_name');
    }

    public function setCustomerFirstName($value)
    {
        return $this->setParameter('customer_first_name', $value);
    }


    public function getCustomerLastName()
    {
        return $this->getParameter('customer_last_name');
    }

    public function setCustomerLastName($value)
    {
        return $this->setParameter('customer_last_name', $value);
    }


    public function getCustomerPhone()
    {
        return $this->getParameter('customer_phone');
    }

    public function setCustomerPhone($value)
    {
        return $this->setParameter('customer_phone', $value);
    }


    public function getCustomerEmail()
    {
        return $this->getParameter('customer_email');
    }

    public function setCustomerEmail($value)
    {
        return $this->setParameter('customer_email', $value);
    }


    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }
}
