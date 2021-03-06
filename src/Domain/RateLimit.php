<?php

namespace Brizido\Tradegecko\Domain;

use Brizido\Tradegecko\TradegeckoException;

trait RateLimit
{
    public function getLimit()
    {
        $return = $this->get('locations', []);
        if(isset($return->type) && ($return->type == 'Bad Request')) {
            throw new TradegeckoException((string) $return->message);
        }

        $headers = $this->response->getXHeaders();
        if(isset($headers['x_rate_limit_remaining'])) {
            return intval($headers['x_rate_limit_remaining']);
        }

        return $return;
    }

}