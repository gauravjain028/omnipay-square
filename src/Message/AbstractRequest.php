<?php

declare(strict_types = 1);

namespace Omnipay\Square\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

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
}
