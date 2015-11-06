<?php

namespace Omnipay\Iyzico;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Common\CreditCard;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testAuthorize()
    {
        $request = $this->gateway->authorize(array(
            'amount' => '10.00'
        ));

        $this->assertInstanceOf('Omnipay\Iyzico\Message\AuthorizeRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }
}
