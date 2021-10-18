<?php

declare(strict_types = 1);

namespace Omnipay\Square\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Throwable;

/**
 * Class AbstractResponse
 *
 * @package Omnipay\Square\Message
 */
abstract class AbstractResponse extends BaseAbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful() : bool
    {
        return !$this->data instanceof Throwable && empty($this->data->getErrors());
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode()
    {
        if ($this->data instanceof Throwable) {
            return $this->data->getCode();
        } elseif ($errors = $this->data->getErrors()) {
            return $errors[0]->getCode();
        }

        return null;
    }

    /**
     * @return string
     */
    public function getMessage() : string
    {
        if ($this->data instanceof Throwable) {
            return $this->data->getCode().': Exception when creating transaction: ' . $this->data->getMessage();
        } elseif ($errors = $this->data->getErrors()) {
            return $errors[0]->getCode().': '. $errors[0]->getDetail();
        }

        return '';
    }

    /**
     * @return mixed|\Square\Exceptions\ApiException|null
     */
    public function getData()
    {
       return $this->data;
    }
}
