<?php

namespace Omnipay\Iyzico\Message;

class VoidRequest extends AuthorizeRequest
{
    /**
     * The value of request type.
     *
     * @return string.
     */
    protected $requestType = 'RV';
}
