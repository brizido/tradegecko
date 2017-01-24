<?php

namespace Brizido\Tradegecko;

abstract class TradegeckoConfig
{
    protected $timeout = 50;
    protected $connectionTimeout = 50;
    protected $decodeJsonAsArray = false;
    protected $gzipEncoding = true;
}