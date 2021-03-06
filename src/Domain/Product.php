<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

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

    public function listProducts($fields = [])
    {
        $return = $this->get('products', $fields);
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }

    public function deleteProduct($productId)
    {
        $deletePath = 'products/' . $productId;
        $return = $this->delete($deletePath, array());
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        return $return;
    }

}