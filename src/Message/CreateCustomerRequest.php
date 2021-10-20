<?php

declare(strict_types = 1);

namespace Omnipay\Square\Message;

use Throwable;
use Square\Apis\CustomersApi;
use Square\Environment;
use Square\Models\CashPaymentDetails;
use Square\Models\CreateCustomerRequest as CreateCustomerRequestModel;
use Square\Models\Money;
use Square\SquareClient;
/**
 * Class CreateCustomerRequest
 *
 * @package Omnipay\Square\Message
 */
class CreateCustomerRequest extends AbstractRequest
{
    /**
     * Get First Name for the customer
     *
     * @return string
     */
    public function getFirstName() : ?string
    {
        return $this->getParameter('firstName');
    }

    /**
     * Set First Name for the customer
     *
     * @param string $value
     * 
     * @return \Omnipay\Square\Message\CreatecustomerRequest
     */
    public function setFirstName(string $value) : CreatecustomerRequest
    {
        return $this->setParameter('firstName', $value);
    }

    /**
     * Get Last Name for the customer
     *
     * @return string
     */
    public function getLastName() : ?string
    {
        return $this->getParameter('lastName');
    }

    /**
     * Set Last Name for the customer
     *
     * @param string $value
     * 
     * @return \Omnipay\Square\Message\CreatecustomerRequest
     */
    public function setLastName(string $value) : CreatecustomerRequest
    {
        return $this->setParameter('lastName', $value);
    }

    /**
     * Get Company Name for the customer
     *
     * @return string
     */
    public function getCompanyName() : ?string
    {
        return $this->getParameter('companyName');
    }

    /**
     * Set Company Name for the customer
     *
     * @param string $value
     * 
     * @return \Omnipay\Square\Message\CreatecustomerRequest
     */
    public function setCompanyName(string $value) : CreatecustomerRequest
    {
        return $this->setParameter('companyName', $value);
    }

    /**
     * Get Email for the customer
     *
     * @return string
     */
    public function getEmail() : ?string
    {
        return $this->getParameter('email');
    }

    /**
     * Set Email for the customer
     *
     * @param string $value
     * 
     * @return \Omnipay\Square\Message\CreatecustomerRequest
     */
    public function setEmail(string $value) : CreatecustomerRequest
    {
        return $this->setParameter('email', $value);
    }

     /**
     * Prepare the data for creating the payment.
     *
     * @return \Square\Models\CreateCustomerRequestModel
     * 
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData() : CreateCustomerRequestModel 
    {
        $data = new CreateCustomerRequestModel;
        $data->setGivenName($this->getFirstName());
        $data->setFamilyName($this->getLastName());
        $data->setCompanyName($this->getCompanyName());
        $data->setEmailAddress($this->getEmail());
        $data->setNote($this->getNote());
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
            $customerApi = $this->getApiInstance();
            $response = $customerApi->createCustomer($body);
        } catch (Throwable $exception) {
            $response = $exception;
        }

        return $this->response = new CreateCustomerResponse($this, $response);
    }


    /**
     * Get environment value according to Square.
     *
     * @return string
     */
    public function getEnvironment() : ?string
    {
        return $this->getTestMode() === true ? Environment::SANDBOX : Environment::PRODUCTION;
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
     * @return \Omnipay\Square\Message\CreateCustomerResponse
     */
    protected function createResponse($data, $headers = []) : CreateCustomerResponse
    {
        return $this->response = new CreateCustomerResponse($this, $data, $headers);
    }
}
