<?php

namespace NelsWebDev\SimpleRouting\Facades;

use NelsWebDev\SimpleRouting\Request as SimpleRoutingRequest;

class Request extends AbstractFacade
{
    /**
     * Get singleton instance of the http request
     */
    public static function getInstance() : SimpleRoutingRequest
    {
        return new SimpleRoutingRequest;
    }
}