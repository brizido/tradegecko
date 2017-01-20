<?php

namespace Brizido\Tradegecko;

class Consumer
{

    /** @var string */
    public $applicationId;

    /** @var string */
    public $secret;

    public function __construct($applicationId, $secret)
    {
        $this->applicationId = $applicationId;
        $this->secret = $secret;
    }

    public function __toString()
    {
        return "Consumer[application_id=$this->applicationId,secret=$this->secret]";
    }

}