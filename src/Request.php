<?php

namespace NelsWebDev\SimpleRouting;

use NelsWebDev\SimpleRouting\Traits\Singleton;

class Request 

{
    use Singleton;

    /**
     * @return string HTTP request method
     */
    public function type() 
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return string full http request path
     */
    public function uri() 
    {
        return trim($_SERVER['REQUEST_PATH'], "/");
    }

    /**
     * @return string http request path without query string
     */
    public function path() 
    {
        return trim($_SERVER['PATH_INFO'] ?? "", "/");
    }

    /**
     * @return string[] array of query request segments 
     ** (e.g. /user/nels => ['user', 'nels'])
     */
    public function parts() 
    {
        $partsOfString = explode('/', $this->path());
        // filter out empty parts
        return array_filter($partsOfString);
    }

}