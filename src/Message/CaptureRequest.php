<?php

namespace Omnipay\Iyzico\Message;

class CaptureRequest extends AuthorizeRequest
{
    /**
     * The value of request type.
     *
     * @return string.
     */
    protected $requestType = 'CP';
}
