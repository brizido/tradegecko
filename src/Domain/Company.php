<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

trait Company
{
    public function addCompany($fields = [])
    {
        $return = $this->post('companies', array('company' => $fields));
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }
}