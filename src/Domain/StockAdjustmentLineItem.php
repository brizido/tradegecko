<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

trait StockAdjustmentLineItem
{
    public function addStockAdjustmentLineItem($fields = [])
    {
        $return = $this->post('stock_adjustment_line_items', array('stock_adjustment_line_item' => $fields));
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }

}