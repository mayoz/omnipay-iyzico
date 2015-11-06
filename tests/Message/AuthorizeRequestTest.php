<?php

namespace Omnipay\Iyzico\Message;

use Omnipay\Common\CreditCard;
use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'amount' => '10.00',
                'currency' => 'TRY',
                'card' => $this->getValidCard(),
                'description' => 'Order #42',
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('PA', $data['type']);
        $this->assertSame('10.00', $data['amount']);
        $this->assertSame('TRY', $data['currency']);
        $this->assertSame('Order #42', $data['descriptor']);
    }
}
