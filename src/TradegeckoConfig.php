<?php

namespace Brizido\Tradegecko;

abstract class TradegeckoConfig
{
    protected $timeout = 5;
    protected $connectionTimeout = 5;
    protected $decodeJsonAsArray = false;
    protected $gzipEncoding = true;
}