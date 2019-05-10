<?php

namespace Omnipay\AlipayHk;

use Omnipay\Common\AbstractGateway;

/**
 * Class MobileGateway
 *
 * @package Omnipay\AlipayHk
 */
class MobileGateway extends AbstractGateway
{

    /**
     * Get gateway display name
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return ' Alipay Hk Mobile gateway';
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


    public function getTransactionRequest()
    {
        return $this->getParameter('transaction_request');
    }

    public function setTransactionRequest($value)
    {
        return $this->setParameter('transaction_request', $value);
    }


    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AlipayHk\Message\MobilePurchaseRequest', $parameters);
    }


    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AlipayHk\Message\MobileCompletePurchaseRequest', $parameters);
    }

    public function query(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AlipayHk\Message\MobileQueryRequest', $parameters);
    }


    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AlipayHk\Message\MobileRefundRequest', $parameters);
    }


    public function completeRefund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\AlipayHk\Message\MobileCompleteRefundRequest', $parameters);
    }
}
