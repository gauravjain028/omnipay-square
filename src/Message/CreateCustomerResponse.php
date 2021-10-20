<?php

declare(strict_types = 1);

namespace Omnipay\Square\Message;

/**
 * Class CreateCustomerResponse
 *
 * @package Omnipay\Square\Message
 */
class CreateCustomerResponse extends AbstractResponse
{
    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference() : ?string
    {
        return $this->isSuccessful() ? $this->data->getResult()->getCustomer()->getId() : null;
    }

    /**
     * Get teh reference id
     *
     * @return null|string
     */
    public function getReferenceId() : ?string
    {
        return $this->isSuccessful() ? $this->data->getResult()->getCustomer()->getReferenceId() : null;
    }
}
