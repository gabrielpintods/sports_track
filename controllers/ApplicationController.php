<?php

/**
 * Class ApplicationController
 * Handles routing for the application.
 */
class ApplicationController{

    /**
     * @var ApplicationController The single instance of this class
     */
    private static ApplicationController $instance;

    /**
     * @var array An associative array where the key is a route to match and the value is a controller file
     */
    private array $routes;

    /**
     * ApplicationController constructor.
     * Initializes the routes array.
     */
    private function __construct(){
        // Sets the controllers and the views of the application.
        $this->routes = [
            '/' => CONTROLLERS_DIR.'/Main.php',
            'error' => CONTROLLERS_DIR.'/error.php'
        ];
    }

    /**
     * Retrieves the single instance of this class.
     * @return ApplicationController The single instance of this class
     */
    public static function getInstance(): ApplicationController{
        if(!isset(self::$instance)){
            self::$instance = new ApplicationController;
        }
        return self::$instance;
    }

    /**
     * Adds a new route in the application.
     * @param String $path the request path.
     * @param String $ctrl the controller that must be called to
     * process the request sent for the path $path.
     * request specified as parameter.
     */
    public function addRoute($path, $ctrl): void {
        $filePath = $ctrl;
        if(!str_ends_with($ctrl, '.php')){
            $filePath = $filePath.".php";    
        }
        if(file_exists($filePath)){
            $this->routes[$path] = $filePath;
        }
    }

    /**
     * Gets the path from the current request URL.
     * @return string The path
     */
    private function request_path(): string {
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $script_name = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
        
        $parts = array_diff_assoc($request_uri, $script_name);
        if (empty($request_uri[0]))
        {
            return '/';
        }
        $path = implode('/', $parts);
        if (($position = strpos($path, '?')) !== FALSE)
        {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    /**
     * Gets PHP classes from the provided PHP code.
     * @param string $php_code PHP code as string
     * @return array An array of PHP class names
     */
    private function get_php_classes($php_code): array {
        $classes = array();
        $tokens = token_get_all($php_code);
        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i - 2][0] == T_CLASS
                && $tokens[$i - 1][0] == T_WHITESPACE
                && $tokens[$i][0] == T_STRING) {

                $class_name = $tokens[$i][1];
                $classes[] = $class_name;
            }
        }
        return $classes;
    }

    /**
     * Extracts PHP classes from a given file path.
     * @param string $filepath The full path to the PHP file
     * @return array An array of PHP class names
     */
    private function file_get_php_classes($filepath): array {
        $php_code = file_get_contents($filepath);
        $classes = $this->get_php_classes($php_code);
        return $classes;
    }

    /**
     * Returns the controller that must be called to process the
     * request sent for the path $path. 
     * @param String $path
     */
    public function process(): void {
        $path = $this->request_path();
        if (array_key_exists($path, $this->routes)){
            $filePath = $this->routes[$path];
            if(!str_ends_with($filePath, '.php')){
                $filePath = $filePath.".php";    
            }
            
            require_once $filePath;
            $ctrl_class = $this->file_get_php_classes($filePath)[0];
            $controller = new $ctrl_class();
            switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET': {
                $controller->get($_REQUEST);
                break;
            }
                case 'PUT':
                case 'DELETE':
                case 'POST': {
                $controller->post($_REQUEST);
                break;
            }

                default:
                $controller->get($_REQUEST);
                break;
            }
        }
        // if (isset($this->routes[$path]) AND is_callable($this->routes[$path])) {
        //     $this->routes[$path]();
        // }
        else {
            $this->routes['error'];
        }
    }

}
