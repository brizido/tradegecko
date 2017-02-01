<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

trait Variant
{
    public function addVariant($fields = [])
    {
        $return = $this->post('variants', array('variant' => $fields));
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }

    public function getVariantBySku($sku)
    {
        $return = $this->get('variants', array('sku' => $sku));
        if(isset($return->variants) && isset($return->variants[0]->id)) {
            return $return->variants[0];
        }

        return null;
    }

}