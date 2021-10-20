<?php

declare(strict_types = 1);

/**
 * Square Gateway.
 */
namespace Omnipay\Square;

use Omnipay\Common\AbstractGateway;
use Omnipay\Square\Message\CreatePaymentRequest;
use Omnipay\Square\Message\CreateCustomerRequest;
use Omnipay\Square\Message\GetCustomerRequest;

/**
 * Square Gateway.
 *
 *
 * @link https://github.com/square/square-php-sdk
 *
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = array())
 */
class Gateway extends AbstractGateway
{
    /**
     * Get name of Gateway
     * 
     * @return string
     */
    public function getName() : string
    {
        return 'Square';
    }

    /**
     * Get the gateway parameters.
     *
     * @return array
     */
    public function getDefaultParameters() : array
    {
        return array(
            'accessToken' => '',
            'locationId' => ''
        );
    }

    /**
     * Get the gateway Access Token.
     *
     * @return string
     */
    public function getAccessToken() : string
    {
        return $this->getParameter('accessToken');
    }

    /**
     * Set the gateway Access Token.
     *
     * @param string $value
     *
     * @return \Omnipay\Common\AbstractGateway
     */
    public function setAccessToken(string $value)
    {
        return $this->setParameter('accessToken', $value);
    }

    /**
     * Get the gateway location id
     * 
     * @return string
     */
    public function getLocationId() : string
    {
        return $this->getParameter('locationId');
    }

    /**
     * Set the gateway location id
     * 
     * @param string $value
     *
     * @return \Omnipay\Common\AbstractGateway
     */
    public function setLocationId($value) : AbstractGateway
    {
        return $this->setParameter('locationId', $value);
    }

    /**
     * Create a Purchase request.
     *
     * @return \Omnipay\Square\Message\CreatePaymentRequest
     */
    public function purchase(array $parameters = array()) : CreatePaymentRequest
    {
        return $this->createRequest(CreatePaymentRequest::class, $parameters);
    }

    /**
     * Create Customer
     *
     * @param array $parameters
     * @return void
     */
    public function createCustomer(array $parameters = []) : CreateCustomerRequest
    {
        return $this->createRequest(CreateCustomerRequest::class, $parameters);
    }

    /**
     * Get Customer
     *
     * @param array $parameters
     * @return GetCustomerRequest
     */
    public function getCustomer(array $parameters = []) : GetCustomerRequest
    {
        return $this->createRequest(GetCustomerRequest::class, $parameters);
    }

    public function updateCustomer(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Square\Message\UpdateCustomerRequest', $parameters);
    }

    

    public function deleteCustomer(array $parameters = [])
    {
        return $this->createRequest('Omnipay\Square\Message\DeleteCustomerRequest', $parameters);
    }

    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = array())
    }
}
