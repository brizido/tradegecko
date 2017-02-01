<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

trait Account
{
    public function getAccounts()
    {
        return $this->get('contacts');
    }
}