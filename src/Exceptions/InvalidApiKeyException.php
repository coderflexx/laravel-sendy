<?php

namespace Coderflex\LaravelSendy\Exceptions;

class InvalidApiKeyException extends \Exception
{
    protected $message = 'The API key is invalid. Please check your configuration and try again.';

    protected $code = 401;
}
