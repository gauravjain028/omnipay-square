<?php

declare(strict_types = 1);

namespace Omnipay\Square\Message;

use Throwable;

/**
 * Class PaymentIntentResponse
 *
 * @package Omnipay\Square\Message
 */
class CreatePaymentResponse extends AbstractResponse
{
    /**
     * @return mixed|string|null
     */
    public function getTransactionId()
    {
        if ($this->data instanceof Throwable) {
            return null;
        }

        return $this->data['charges']['data'][0]['id'] ?? null;
    }

    /**
     * @return mixed|string|null
     */
    public function getTransactionReference()
    {
        return $this->getTransactionId();
    }
}
