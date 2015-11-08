<?php

namespace Omnipay\Iyzico\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{
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
     * Get the api endpoint url.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return 'https://iyziconnect.com/post/v1/';
    }

    /**
     * Get HTTP Method.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * Get data with merged the defaults data.
     *
     * @param  array  $data
     * @return array
     */
    public function getMergedData($data)
    {
        return array_merge(array(
            'api_id'        => $this->getApiKey(),
            'secret'        => $this->getApiSecret(),
            'response_mode' => 'SYNC',
            'mode'          => $this->getTestMode() ? 'test' : 'live',
        ), $data);
    }

    /**
     * Get the card data.
     *
     * @return array
     */
    protected function getCardData()
    {
        $this->validate('card');

        $card = $this->getCard();

        $card->validate();

        return array(
            'card_number'       => $card->getNumber(),
            'card_expiry_year'  => $card->getExpiryYear(),
            'card_expiry_month' => $card->getExpiryMonth(),
            'card_brand'        => $card->getBrand(),
            'card_holder_name'  => $card->getName(),
            'card_verification' => $card->getCvv(),
        );
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed  $data
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            null,
            $this->getMergedData($data)
        );

        $httpResponse = $httpRequest->send();

        return $this->response = new Response($this, $httpResponse->json());
    }
}
