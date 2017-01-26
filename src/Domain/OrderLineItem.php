<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

trait OrderLineItem
{
    public function addOrderLineItem($fields = [])
    {
        $return = $this->post('order_line_items', array('order_line_item' => $fields));
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }
    
}