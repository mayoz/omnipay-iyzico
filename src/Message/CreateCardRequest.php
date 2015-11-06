<?php

namespace Omnipay\Iyzico\Message;

class CreateCardRequest extends AbstractRequest
{
    /**
     * Get the raw data array for this message.
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('card');

        return $this->getCardData();
    }

    /**
     * Get the api endpoint url.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return 'https://iyziconnect.com/register-card/v1/';
    }
}
