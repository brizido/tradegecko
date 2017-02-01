<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

trait StockAdjustment
{
    public function addStockAdjustment($fields = [])
    {
        $return = $this->post('stock_adjustments', array('stock_adjustment' => $fields));
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }

}