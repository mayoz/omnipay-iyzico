<?php

namespace Omnipay\Iyzico;

use Omnipay\Common\AbstractGateway;
use Omnipay\Iyzico\Message\AuthorizeRequest;
use Omnipay\Iyzico\Message\CaptureRequest;
use Omnipay\Iyzico\Message\CreateCardRequest;
use Omnipay\Iyzico\Message\DeleteCardRequest;
use Omnipay\Iyzico\Message\PurchaseRequest;
use Omnipay\Iyzico\Message\RefundRequest;
use Omnipay\Iyzico\Message\VoidRequest;

class Gateway extends AbstractGateway
{
    /**
     * Get gateway display name
     *
     * @return string
     */
    public function getName()
    {
        return 'Iyzico';
    }

    /**
     * Get the gateway parameters.
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'apiKey' => '',
            'apiSecret' => '',
            'bankName' => 'Garanti',
            'testMode' => false,
        );
    }

    /**
     * Get the gateway api key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set the gateway api key.
     *
     * @param  string  $value
     * @return static
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get the gateway api secret.
     *
     * @return string
     */
    public function getApiSecret()
    {
        return $this->getParameter('apiSecret');
    }

    /**
     * Set the gateway api secret.
     *
     * @param  string  $value
     * @return static
     */
    public function setApiSecret($value)
    {
        return $this->setParameter('apiSecret', $value);
    }

    /**
     * Get the gateway bank name.
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->getParameter('bankName');
    }

    /**
     * Set the gateway bank name.
     *
     * @param  string  $value
     * @return static
     */
    public function setBankName($value)
    {
        return $this->setParameter('bankName', $value);
    }

    /**
     * Authorize request.
     *
     * @param  array  $parameters
     * @return \Omnipay\Iyzico\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest(AuthorizeRequest::class, $parameters);
    }

    /**
     * Capture request.
     *
     * @param  array $parameters
     * @return \Omnipay\Iyzico\Message\CaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest(CaptureRequest::class, $parameters);
    }

    /**
     * Purchase request.
     *
     * @param  array  $parameters
     * @return \Omnipay\Iyzico\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * Refund request.
     *
     * @param  array  $parameters
     * @return \Omnipay\Iyzico\Message\RefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest(RefundRequest::class, $parameters);
    }

    /**
     * Fetch transaction request.
     *
     * @param  array  $parameters
     * @return \Omnipay\Iyzico\Message\VoidRequest
     */
    public function void(array $parameters = array())
    {
        return $this->createRequest(VoidRequest::class, $parameters);
    }

    /**
     * Create a new card.
     *
     * @param  array  $parameters
     * @return \Omnipay\Iyzico\Message\CreateCardRequest
     */
    public function createCard(array $parameters = array())
    {
        return $this->createRequest(CreateCardRequest::class, $parameters);
    }

    /**
     * Delete a card.
     *
     * @param  array  $parameters
     * @return \Omnipay\Iyzico\Message\DeleteCardRequest
     */
    public function deleteCard(array $parameters = array())
    {
        return $this->createRequest(DeleteCardRequest::class, $parameters);
    }
}
