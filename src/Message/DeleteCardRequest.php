<?php

namespace Omnipay\Iyzico\Message;

class DeleteCardRequest extends AbstractRequest
{
    /**
     * Get the raw data array for this message.
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('cardReference');

        return array('card_token' => $this->getCardReference());
    }

    /**
     * Get the api endpoint url.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return 'https://iyziconnect.com/delete-card/v1/';
    }
}
