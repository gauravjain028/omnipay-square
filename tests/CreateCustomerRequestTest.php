<?php

namespace Omnipay\Square;

use Omnipay\Tests\GatewayTestCase;

/**
 * CreateCustomerRequestTest
 */
class CreateCustomerRequestTest extends GatewayTestCase
{
    const ACCESS_TOKEN = 'EAAAELhoU7_U1VFyvW0VbkvjyYZnqnHz1hjScKur0MP5--htcr4FGh4bxWFrwiAa';

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setAccessToken('sas');
        $this->gateway->setTestMode(true);
    }

    public function testCreateCustomerRequest_UNAUTHORIZED()
    {
        $request = $this->gateway->createCustomer([]);
        $request->setIdempotencyKey(uniqid());
        $response = $request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('UNAUTHORIZED', $response->getCode());
    }

    public function testCreateCustomerRequestByCash()
    {
        $this->gateway->setAccessToken(self::ACCESS_TOKEN);
        $request = $this->gateway->createCustomer([]);
        $request->setIdempotencyKey(uniqid());
        $referenceID = uniqid();
        $request->setReferenceId($referenceID);
        $request->setEmail('foo@bar.com');
        $response = $request->send();
    
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals($referenceID, $response->getReferenceId());
        $this->assertEquals('foo@bar.com', $response->getData()->getResult()->getCustomer()->getEmailAddress());
    }
}
