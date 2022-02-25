# Simple HTTP Routing

Use a simple http router to handle web requests, using a syntax inspired by Laravel. 




### Sample

```php
use NelsWebDev\SimpleRouting\Facades\Router;

require __dir__ . "/vendor/autoload.php";

Router::get("", function(){
    echo "hello world!";
});

```


### Under Development

This application is still under the early development phase and should not be used for a working application. 