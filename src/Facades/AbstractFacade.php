<?php

namespace NelsWebDev\SimpleRouting\Facades;

use ReflectionClass;

/**
 * Facade based implementation for Router application. 
 */

abstract class AbstractFacade
{
    /**
     * Get instance of facade from container (e.g. singleton or null object)
     */ 
    abstract static function getInstance();

    /**
     * Handles when a facade is called as a function
     * @param [type] $name name of the function called
     * @param [type] $arguments arguments passed to the function
     */
    public static function __callStatic($name, $arguments)
    {
        $instance = static::getInstance();

        if (!$instance || !is_object($instance)) {
            throw new \Exception("Facade instance not found");
        }

        $instance->{$name}(...$arguments);
    }

    /**
     * Get a property of the facade instance
     * @param string $name property name
     */
    public function __get(string $name)
    {
        return static::getInstance()->$name;
    }
}