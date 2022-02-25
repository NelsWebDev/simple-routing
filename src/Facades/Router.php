<?php

namespace NelsWebDev\SimpleRouting\Facades;

use NelsWebDev\SimpleRouting\Router as SimpleRoutingRouter;

class Router extends AbstractFacade
{
    /**
     * Get singleton instance of Router 
     * @return SimpleRoutingRouter
     */
    static function getInstance() : SimpleRoutingRouter  {
        return SimpleRoutingRouter::getInstance();
    }
}