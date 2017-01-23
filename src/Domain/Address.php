<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

trait Address
{
    public function getAddressById($id)
    {
        return $this->get("addresses/$id");
    }

    public function addAddress($fields = [])
    {
        $return = $this->post('addresses', array('address' => $fields));
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }
}