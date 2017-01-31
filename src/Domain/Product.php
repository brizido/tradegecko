<?php

namespace Brizido\Tradegecko\Domain;

trait Product
{
    public function addProduct($fields = [])
    {
        $return = $this->post('products', array('product' => $fields));
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }

}