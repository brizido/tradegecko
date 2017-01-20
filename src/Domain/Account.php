<?php

namespace Brizido\Tradegecko\Domain;

trait Account
{
    public function getAccounts()
    {
        return $this->get('contacts');
    }
}