<?php

declare(strict_types = 1);

namespace Omnipay\Square\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Square\Environment;

/**
 * Class AbstractRequest
 *
 * @package Omnipay\Square\Commerce\Message
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * @param mixed $data
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    abstract public function sendData($data);

    /**
     * Get environment value according to Square.
     *
     * @return string
     */
    public function getEnvironment() : string
    {
        return $this->getTestMode() === true ? Environment::SANDBOX : Environment::PRODUCTION;
    }
    
    /**
     * Get the request access token.
     *
     * @return string
     */
    public function getAccessToken() : string
    {
        return $this->getParameter('accessToken');
    }

    /**
     * Sets the request access token.
     *
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setAccessToken(string $value) : AbstractRequest
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
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setLocationId($value) : AbstractRequest
    {
        return $this->setParameter('locationId', $value);
    }

    /**
     * Get idempotencyKey for the payment
     *
     * @return string
     */
    public function getIdempotencyKey() : string
    {
        return $this->getParameter('idempotencyKey');
    }

    /**
     * set idempotencyKey for the payment
     *
     * @param string $value
     * 
     * @return \Omnipay\Square\Message\AbstractRequest
     */
    public function setIdempotencyKey(string $value) : AbstractRequest
    {
        return $this->setParameter('idempotencyKey', $value);
    }

    /**
     * Get Reference id
     *
     * @return string
     */
    public function getReferenceId() : ?string
    {
        return $this->getParameter('referenceId');
    }

    /**
     * Set Reference id
     *
     * @param string $value
     * 
     * @return \Omnipay\Square\Message\AbstractRequest
     */
    public function setReferenceId(string $value) : AbstractRequest
    {
        return $this->setParameter('referenceId', $value);
    }

    /**
     * Get note
     *
     * @return string|null
     */
    public function getNote() : ?string
    {
        return $this->getParameter('note');
    }

    /**
     * Set note
     *
     * @param string $value
     * 
     * @return \Omnipay\Square\Message\AbstractRequest
     */
    public function setNote(string $value) : AbstractRequest
    {
        return $this->setParameter('note', $value);
    }
}
