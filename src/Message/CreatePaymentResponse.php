<?php

declare(strict_types = 1);

namespace Omnipay\Square\Message;

/**
 * Class CreatePaymentResponse
 *
 * @package Omnipay\Square\Message
 */
class CreatePaymentResponse extends AbstractResponse
{
    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference() : ?string
    {
        return $this->isSuccessful() ? $this->data->getResult()->getPayment()->getId() : null;
    }

    /**
     * Get the transaction ID as generated by the merchant website.
     *
     * @return null|string
     */
    public function getTransactionId() : ?string
    {
        return $this->getReferenceId();
    }


    /**
     * Get teh reference id
     *
     * @return null|string
     */
    public function getReferenceId() : ?string
    {
        return $this->isSuccessful() ? $this->data->getResult()->getPayment()->getReferenceId() : null;
    }
}
