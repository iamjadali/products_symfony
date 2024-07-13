<?php
// src/Exception/CustomProductPriceTypeException.php
namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CustomProductPriceTypeException extends BadRequestHttpException
{
    public function __construct(string $message = 'The type of the "price" attribute must be a string.', \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct($message, $previous, $code, $headers);
    }
}

