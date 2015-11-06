<?php

namespace Omnipay\Iyzico\Message;

class AuthorizeRequest extends AbstractRequest
{
    /**
     * The value of request type.
     *
     * @return string.
     */
    protected $requestType = 'PA';

    /**
     * Get the raw data array for this message.
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = array(
            'type'        => $this->requestType,
            'amount'      => $this->getAmount(),
            'currency'    => strtoupper($this->getCurrency()),
            'descriptor'  => $this->getDescription(),
            'external_id' => $this->getTransactionId(),
        );

        // transaction
        if (in_array($this->requestType, array('CP', 'RV', 'RF'))) {
            return array_merge($data, array(
                'transaction_id' => $this->getTransactionReference()
            ));
        }

        // purchase
        return array_merge($data, $this->getCardFactory());
    }

    /**
     * Get defined card (card information or reference) value.
     *
     * @return array
     */
    protected function getCardFactory()
    {
        if ($token = $this->getCardReference()) {
            return array('card_token' => $token);
        }

        return $this->getCardData();
    }
}
