<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

trait Order
{
    public function addOrder($fields = [])
    {
        $return = $this->post('orders', array('order' => $fields));
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }

    public function invoiceOrder($orderId)
    {
        $endpoint = 'orders/' . intval($orderId) . '/actions/invoice';
        $return = $this->post($endpoint, []);
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }
}