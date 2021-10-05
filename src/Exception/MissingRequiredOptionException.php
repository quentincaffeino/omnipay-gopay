<?php

declare(strict_types=1);

namespace Omnipay\GoPay\Exception;

class MissingRequiredOptionException extends \RuntimeException
{
    function __construct(string $operationName, string $fieldName)
    {
        parent::__construct(sprintf("%s is missing required option '%s'.", ucfirst(mb_strtolower($operationName)), $fieldName));
    }
}
