<?php

namespace Omnipay\Iyzico\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{
    /**
     * Is the transaction successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        if (isset($this->data['response']['state'])) {
            return $this->data['response']['state'] == 'success';
        }
    }

    /**
     * Get the transaction reference.
     *
     * @return string|null
     */
    public function getTransactionReference()
    {
        if ($this->isSuccessful()) {
            if (isset($this->data['transaction']['transaction_id'])) {
                return $this->data['transaction']['transaction_id'];
            }
        }
    }

    /**
     * Get the card reference.
     *
     * @return string|null
     */
    public function getCardReference()
    {
        if ($this->isSuccessful()) {
            if (isset($this->data['card_token'])) {
                return $this->data['card_token'];
            }
        }
    }

    /**
     * Get the reference factory.
     *
     * @return string|null
     */
    public function getReference()
    {
        if ($reference = $this->getTransactionReference()) {
            return $reference;
        }

        return $this->getCardReference();
    }

    /**
     * Does the response require a redirect?
     *
     * @return bool
     */
    public function isRedirect()
    {
        return false;
    }

    /**
     * Get the required redirect method (either GET or POST).
     *
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    /**
     * Gets the redirect form data array, if the redirect method is POST.
     *
     * @return array
     */
    public function getRedirectData()
    {
        return array();
    }

    /**
     * Get the error message.
     *
     * @return string
     */
    public function getError()
    {
        if (isset($this->data['response']['error_message'])) {
            return $this->data['response']['error_message'];
        }
    }

    /**
     * Get all response data.
     *
     * @return mixed
     */
    public function getBody()
    {
        return $this->data;
    }

    /**
     * Get all response data with serialized.
     *
     * @return mixed
     */
    public function getJson()
    {
        return json_encode($this->getBody());
    }
}
