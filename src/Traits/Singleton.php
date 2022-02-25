<?php

namespace NelsWebDev\SimpleRouting\Traits;

trait Singleton 

{
    private static $instance;

    /**
     * Prevent instance from being extended and instantiated
     */
    final function __construct(){}

    /**
     * Get instance of a singleton
     *
     * @return static
     */
    public static function getInstance() 
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}