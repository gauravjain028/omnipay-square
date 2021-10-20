<?php

namespace Omnipay\Square;

use Omnipay\Tests\GatewayTestCase;

/**
 * @property Gateway gateway
 */
class ChargeGatewayTest extends GatewayTestCase
{
    const ACCESS_TOKEN = 'EAAAELhoU7_U1VFyvW0VbkvjyYZnqnHz1hjScKur0MP5--htcr4FGh4bxWFrwiAa';

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setAccessToken('sas');
        $this->gateway->setTestMode(true);
    }

    public function testPurchase_UNAUTHORIZED()
    {
        $request = $this->gateway->purchase(array('source_id' => 'any-random-value','amount' => '10.00', 'currency' => 'USD'));
        $request->setIdempotencyKey(uniqid());
        $response = $request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('UNAUTHORIZED', $response->getCode());
    }

    public function testPurchase_BAD_REQUEST()
    {
        $this->gateway->setAccessToken(self::ACCESS_TOKEN);
        $request = $this->gateway->purchase(array('source_id' => 'any-random-value','amount' => '10.00', 'currency' => 'USD'));
        $request->setIdempotencyKey(uniqid());
        $response = $request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('BAD_REQUEST', $response->getCode());
    }

    public function testPurchaseByCash()
    {
        $this->gateway->setAccessToken(self::ACCESS_TOKEN);
        $request = $this->gateway->purchase(array('source_id' => 'any-random-value','amount' => '10.00', 'currency' => 'USD'));
        $request->setIdempotencyKey(uniqid());
        $referenceID = uniqid();
        $request->setReferenceId($referenceID);
        $request->setSourceId('CASH');
        $response = $request->send();
    
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals(NULL, $response->getCode());
        $this->assertEquals($referenceID, $response->getTransactionId());
    }
}
