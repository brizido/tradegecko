<?php

namespace Brizido\Tradegecko\Domain;

trait Address
{
    public function getAddressById($id)
    {
        return $this->get("addresses/$id");
    }
}