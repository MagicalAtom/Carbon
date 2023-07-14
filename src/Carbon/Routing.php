<?php
namespace Apex\Router;

use ReflectionMethod;

class Routing{
/*
 * Nothing , Be Happy :)
 */
    private $user_current_route;
    private $method_field;
    private $routes;
    private $values = [];

    public function __construct()
    {
        $this->user_current_route = explode('/', USER_CURRENT_ROUTE);

        $this->method_field = $this->methodField();

        global $routes;
        $this->routes = $routes;

    }

    public function run(){

        $match = $this->match();
        if(empty($match)){
            $this->notFoundError();
        }


        $classPath = str_replace('\\', '/', $match["class"]);
        $path = BASE_DIR . "/app/Http/Controllers/".$classPath.".php";

        if(!file_exists($path)){
            self::notFoundError();
        }

        $class = "\App\Http\Controllers\\".$match["class"];
        $object = new $class();
        if(method_exists($object, $match["method"])){
            $reflection = new ReflectionMethod($class, $match["method"]);
            $parameterCount = $reflection->getNumberOfParameters();
            if($parameterCount <= count($this->values)){
             echo    call_user_func_array([$object, $match["method"]], $this->values);
            }
            else{
                die("Parameter X");

            }
        }
        else{
            die("{$match['class']} --------> {$match['method']}()" . '  Not Found ');

        }
    }

    public function match(){

        $reservedRoutes = $this->routes[$this->method_field];
        foreach ($reservedRoutes as $reservedRoute) {
            if($this->compare($reservedRoute['url']) == true){
                return ["class" => $reservedRoute['class'], "method" => $reservedRoute['method']];
            }
            else{
                $this->values = [];
            }
        }
        return [];
    }

    private function compare($reservedRouteUrl){

        //part1
        if(trim($reservedRouteUrl, '/') === ''){
            return trim($this->user_current_route[0], '/') === '' ? true : false;
        }

        //part2
        $reservedRouteUrlArray = explode('/', $reservedRouteUrl);
        if(sizeof($this->user_current_route) != sizeof($reservedRouteUrlArray)){
            return false;
        }

        //part3
        foreach ($this->user_current_route as $key => $currentRouteElement) {
            $reservedRouteUrlElement = $reservedRouteUrlArray[$key];
            if(substr($reservedRouteUrlElement, 0, 1) == "{" && substr($reservedRouteUrlElement, -1) == "}"){
                array_push($this->values, $currentRouteElement);
            }
            elseif($reservedRouteUrlElement != $currentRouteElement){
                return false;
            }
        }
        return true;

    }

    public function notFoundError(){

        http_response_code(404);
        include __DIR__ . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'NotFound.php';
        exit;

    }

    public function methodField(){

        $method_field = strtolower($_SERVER['REQUEST_METHOD']);

        if($method_field == 'post'){

            if(isset($_POST['_method'])){

                if($_POST['_method'] == 'put'){
                    $method_field = 'put';
                }
                elseif($_POST['_method'] == 'delete'){
                    $method_field = 'delete';
                }
            }

        }
        return $method_field;

    }



}
