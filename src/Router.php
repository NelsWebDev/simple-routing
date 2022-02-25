<?php

namespace NelsWebDev\SimpleRouting;

use NelsWebDev\SimpleRouting\Traits\Singleton;

class Router 

{
    use Singleton;

    /**
     *  @var Route[] array of registered routes
     */
    private $routes = [];

    /**
     * Register a route to the router
     *
     * @param string $method HTTP request type (GET, POST, PUT, DELETE)
     * @param string $route Route path
     * @param callable $handler Callable handler
     */
    public function register(string $type, string $route, callable $handler) : self
    {
        $this->routes[] = new Route($type, $route, $handler);
        return $this;
    }

    /**
     * Register a GET route
     *
     * @param string $route Route path
     * @param callable $handler Callable handler
     */
    public function get(string $route, callable $handler) : self
    {
        return $this->register('GET', $route, $handler);
    }

    /**
     * Register a POST route
     *
     * @param string $route Route path
     * @param callable $handler Callable handler
     */
    public function post(string $route, callable $handler) : self
    {
        return $this->register('POST', $route, $handler);
    }

    /**
     * Register a PUT route
     *
     * @param string $route Route path
     * @param callable $handler Callable handler
     */
    public function put(string $route, callable $handler) : self
    {
        return $this->register('PUT', $route, $handler);
    }

    /**
     * Register a DELETE route
     *
     * @param string $route Route path
     * @param callable $handler Callable handler
     */
    public function delete(string $route, callable $handler) : self
    {
        return $this->register('DELETE', $route, $handler);
    }

    /**
     * @return Route[] array of registered routes
     */
    public function getRoutes(){
        return $this->routes;
    }

    /**
     * Set a default handler for unmatched routes
     *
     * @param callable $handler
     */
    public function default(callable $handler) : self
    {
       $this->defaultHandler = $handler;
       return $this;
    }

    /**
     * Run the router, finding the correct route for requested path
     */
    public function run() 
    {
        $routes = $this->getRoutes();
        foreach($routes as $route){
            if($route->matchesRequest()){
                return call_user_func($route);
            }
        }
        $this->handle404(); // handle 404 if no route matches
    }

    /**
     * Handle a 404 error if no matching route is found
     */
    private function handle404()
    {
        http_response_code(404);
        if(isset($this->defaultHandler)){
            return call_user_func($this->defaultHandler);
        }
        $this->displayDefault404();
    }
    
    /**
     * Display the default message for 404 error
     */
    protected function displayDefault404() 
    {
        include __DIR__ . "/views/error_404.html";
    }


}