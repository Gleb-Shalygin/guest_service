<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    protected $code = 404;

    public function __construct(string $message = '', string $errorCode = '', Throwable $previous = null)
    {
        parent::__construct("$message", $this->code, $previous);
    }
}
