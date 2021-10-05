<?php

declare(strict_types=1);

namespace Omnipay\GoPay\Exception;

class MalformedOptionException extends \RuntimeException
{
    function __construct(string $operationName, string $fieldName, string $message)
    {
        parent::__construct(sprintf("%s has been passed a malformed option '%s', %s.", ucfirst(mb_strtolower($operationName)), $fieldName, $message));
    }
}
