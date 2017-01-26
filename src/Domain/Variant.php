<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

trait Variant
{
    public function getVariantBySku($sku)
    {
        $return = $this->get('variants', array('sku' => $sku));
        return $return;
    }

}