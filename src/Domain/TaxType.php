<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

trait TaxType
{
    public function getTaxtTypes()
    {
        $return = $this->get('tax_types');
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }

}