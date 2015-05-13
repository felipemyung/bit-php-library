<?php

namespace BandsInTownApi\Components\Exceptions;

/**
 * Class InvalidApiKeyException
 *
 * @package BandsInTownApi\Components\Exceptions
 */
class InvalidApiKeyException extends BandsInTownApiException
{
    /**
     * @var string
     */
    protected $message = 'invalid api key';
}