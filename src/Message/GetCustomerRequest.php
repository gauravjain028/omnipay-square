<?php

declare(strict_types = 1);

namespace Omnipay\Square\Message;

use Throwable;
use Square\Apis\CustomersApi;
use Square\SquareClient;
/**
 * Class GetCustomerRequest
 *
 * @package Omnipay\Square\Message
 */
class GetCustomerRequest extends AbstractRequest
{
    /**
     * Get Id for the customer
     *
     * @return string
     */
    public function getId() : ?string
    {
        return $this->getParameter('id');
    }

    /**
     * Set Id for the customer
     *
     * @param string $value
     * 
     * @return \Omnipay\Square\Message\GetCustomerRequest
     */
    public function setId(string $value) : GetCustomerRequest
    {
        return $this->setParameter('id', $value);
    }

    /**
     * Prepare the data for creating the payment.
     *
     * @return array
     * 
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData() : array
    {
        $this->validate('id');

        return [
            'customer_id' => $this->getId()
        ];
    }

    /**
     * Send data and return response instance.
     *
     * @param mixed $data
     *
     * @return mixed
     */
    public function sendData($data)
    {
        try {
            $customerApi = $this->getApiInstance();
            $response = $customerApi->retrieveCustomer($data['customer_id']);
        } catch (Throwable $exception) {
            $response = $exception;
        }

        return $this->response = new GetCustomerResponse($this, $response);
    }
    
    /**
     * Get required Api instance for this request
     *
     * @return CustomersApi
     */
    protected function getApiInstance() : CustomersApi
    {
        $api_client = new SquareClient([
            'accessToken' => $this->getAccessToken(),
            'environment' => $this->getEnvironment()
        ]);

        return $api_client->getCustomersApi();
    }

    /**
     * @param       $data
     * @param array $headers
     *
     * @return \Omnipay\Square\Message\GetCustomerResponse
     */
    protected function createResponse($data, $headers = []) : GetCustomerResponse
    {
        return $this->response = new GetCustomerResponse($this, $data, $headers);
    }
}
