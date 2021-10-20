<?php

declare(strict_types = 1);

namespace Omnipay\Square\Message;

/**
 * Class GetCustomerResponse
 *
 * @package Omnipay\Square\Message
 */
class GetCustomerResponse extends AbstractResponse
{
    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getCustomerReference() : ?string
    {
        return $this->isSuccessful() ? $this->data->getResult()->getCustomer()->getId() : null;
    }
}
