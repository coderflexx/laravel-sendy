<?php

namespace Coderflex\LaravelSendy\Exceptions;

class InvalidApiUrlException extends \Exception
{
    protected $message = 'The API URL is invalid. Please check your configuration and try again.';

    protected $code = 401;
}
