<?php

namespace NelsWebDev\SimpleRouting;

use NelsWebDev\SimpleRouting\Facades\Request;

class Route
{
    /**
     * @var string Request method ("GET"|"POST"|"PUT"|"DELETE")
     */
    private $type;

    /**
     * @var string Request path
     */
    private $path;

    /**
     * @var callable Callable function invoked if request matches
     */
    private $handler;

    public function __construct(string $type, string $path, callable $handler)
    {

        if (!in_array($type, ['GET', 'POST', 'PUT', 'DELETE'])) {
            throw new \Exception("Method type not supported");
        }

        $this->type = $type;
        $this->path = $path;
        $this->handler = $handler;
    }

    /** 
     * @return string Request method ("GET"|"POST"|"PUT"|"DELETE")
     */
    public function getType() : string 
    {
        return $this->type;
    }

    /**
     *
     * @return string Request path
     */
    public function getPath() : string
    {
        return $this->route;
    }

    /**
     * @return callable Callable function invoked if request matches
     */
    public function getHandler() : callable
    {
        return $this->handler;
    }

    /**
     *  Invoke the handler
     */
    public function __invoke()
    {
        return call_user_func($this->handler);
    }

    /**
     * Checks if the route matches the current request
     *
     * @return void
     */
    public function matchesType() : bool
    {
        return $this->type == Request::type();
    }

    /**
     * Get segments of the route path (e.g. /users/:id)
     * @return string[] Array of segments
     */
    public function getParts() : array
    {
        return array_filter(explode('/', $this->path));
    }

    /**
     * Get partials that match the current request
     *
     * @return string[] Array containing the matched segments
     */
    public function getPartialMatch() : array
    {
        $uriParts = Request::parts();
        $routeParts = explode('/', $this->path);
        $match = [];
        foreach ($routeParts as $key => $routePart) {
            if (isset($uriParts[$key]) && $routePart == $uriParts[$key]) {
                $match[] = $uriParts[$key];
            }
        }
        return $match;
    }


    /**
     * Check if the route matches the current request
     *
     * @return void
     */
    public function matchesRequest()
    {
        if (!$this->matchesType()) {
            return false;
        }

        if (count($this->getParts()) != count(Request::parts())) {
            return false;
        }

        $uriParts = Request::parts();
        $routeParts = explode('/', $this->path);
        $match = [];
        foreach ($routeParts as $key => $routePart) {
            if (isset($uriParts[$key]) && $routePart == $uriParts[$key]) {
                $match[] = $uriParts[$key];
            }
        }
        return $match;
    }
}
