<?php

namespace Brizido\Tradegecko\Domain;

trait Variant
{
    public function getVariantBySku($sku)
    {
        $return = $this->get('variants', array('sku' => $sku));
        if(isset($return->variants) && isset($return->variants[0]->id)) {
            return $return->variants[0];
        }

        return null;
    }

}