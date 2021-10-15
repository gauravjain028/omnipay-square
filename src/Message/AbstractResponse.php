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
        return !$this->data instanceof Throwable && !empty($this->data->getErrors());
    }

    /**
     * @return string
     */
    public function getMessage() : string
    {
        return ($this->data instanceof Throwable) ? $this->data->getMessage() : '';
    }

    /**
     * @return mixed|\Square\Exceptions\ApiException|null
     */
    public function getData()
    {
        if ($this->data instanceof Throwable) {
            return $this->data->getMessage();
        } else {
            return $this->data;
        }
    }
}
