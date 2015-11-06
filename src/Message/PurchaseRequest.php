<?php

namespace Omnipay\Iyzico\Message;

class PurchaseRequest extends AuthorizeRequest
{
    /**
     * The value of request type.
     *
     * @return string.
     */
    protected $requestType = 'DB';
}
