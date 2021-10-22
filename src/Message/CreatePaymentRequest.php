<?php

declare(strict_types = 1);

namespace Omnipay\Square\Message;

use Throwable;
use Square\Apis\PaymentsApi;
// use Square\Models\CashPaymentDetails;
use Square\Models\CreatePaymentRequest as CreatePaymentRequestModel;
use Square\Models\Money;
use Square\SquareClient;
/**
 * Class CreatePaymentRequest
 *
 * @package Omnipay\Sqaure\Message
 */
class CreatePaymentRequest extends AbstractRequest
{
    /**
     * Get source id for the payment
     *
     * @return string
     */
    public function getSourceId() : string
    {
        return $this->getParameter('sourceId');
    }

    /**
     * set source id for the payment
     *
     * @param string $value
     * 
     * @return \Omnipay\Square\Message\CreatePaymentRequest
     */
    public function setSourceId(string $value) : CreatePaymentRequest
    {
        return $this->setParameter('sourceId', $value);
    }

    /**
     * Get verification token
     *
     * @return string|null
     */
    public function getVerificationToken() : ?string
    {
        return $this->getParameter('verificationToken');
    }

    /**
     * Get verification token
     *
     * @param string $value
     * 
     * @return \Omnipay\Square\Message\CreatePaymentRequest
     */
    public function setVerificationToken(string $value) : CreatePaymentRequest
    {
        return $this->setParameter('verificationToken', $value);
    }

     /**
     * Prepare the data for creating the payment.
     *
     * @return \Square\Models\CreatePaymentRequest
     * 
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData() : CreatePaymentRequestModel 
    {
        $this->validate('amount', 'currency', 'idempotencyKey');

        // prepare the amount 
        $amountMoney = new Money();
        $amountMoney->setAmount($this->getAmountInteger());
        $amountMoney->setCurrency($this->getCurrency());
        
        // validate the source
        if ($this->getSourceId()) {
            $sourceId = $this->getSourceId();
        } else {
            $this->validate('sourceId');
        }

        // create payment request
        $data = new CreatePaymentRequestModel($sourceId, $this->getIdempotencyKey(), $amountMoney);
        $data->setLocationId($this->getLocationId());
        $data->setNote($this->getNote());

        // verify the token if given
        if ($this->getVerificationToken()) {
            $data->setVerificationToken($this->getVerificationToken());
        }
        
        // do not enable cash, only for testing
        // if ($sourceId === 'CASH') {
        //     $cash = new CashPaymentDetails($amountMoney);
        //     $data->setCashDetails($cash);
        // }

        $data->setReferenceId($this->getReferenceId());

        return $data;
    }

    /**
     * Send data and return response instance.
     *
     * @param mixed $body
     *
     * @return mixed
     */
    public function sendData($body)
    {
        try {
            $paymentsApi = $this->getApiInstance();
            $response = $paymentsApi->createPayment($body);
        } catch (Throwable $exception) {
            $response = $exception;
        }

        return $this->response = new CreatePaymentResponse($this, $response);
    }
    
    /**
     * Get required Api instance for this request
     *
     * @return PaymentsApi
     */
    protected function getApiInstance() : PaymentsApi
    {
        $api_client = new SquareClient([
            'accessToken' => $this->getAccessToken(),
            'environment' => $this->getEnvironment()
        ]);

        return $api_client->getPaymentsApi();
    }

    /**
     * @param       $data
     * @param array $headers
     *
     * @return \Omnipay\Square\Message\CreatePaymentResponse
     */
    protected function createResponse($data, $headers = []) : CreatePaymentResponse
    {
        return $this->response = new CreatePaymentResponse($this, $data, $headers);
    }
}
