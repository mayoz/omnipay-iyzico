<?php

namespace Omnipay\Iyzico\Message;

class RefundRequest extends AuthorizeRequest
{
    /**
     * The value of request type.
     *
     * @return string.
     */
    protected $requestType = 'RF';
}
