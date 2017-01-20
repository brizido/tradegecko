<?php

namespace Brizido\Tradegecko;

class PrivilegedAccessToken
{

    /** @var string */
    public $accessToken;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }
}