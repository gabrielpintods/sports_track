<?php
/**
 * Abstract class extended by controllers to handle
 * HTTP requests such as POST, GET, etc.
 */
abstract class Controller{

    /**
     * Method called to handle an HTTP GET request.
     */
    public function get($request): void{
        $this->render('error', ['message' => 'Method HTTP GET not allowed!']);
    }

    /**
     * Method called to handle an HTTP POST request.
     */
    public function post($request): void{
        $this->render('error', ['message' => 'Method HTTP POST not allowed!']);
    }

    /**
     * Method called to handle an HTTP PUT request.
     */
    public function put($request): void{
        $this->render('error', ['message' => 'Method HTTP PUT not allowed!']);
    }

    /**
     * Method called to handle an HTTP DELETE request.
     */
    public function delete($request): void {
        $this->render('error', ['message' => 'Method HTTP DELETE not allowed!']);
    }

    /**
     * Method called to display a view
     * @param String $view The name of the file containing the view that should
     * be returned to the client.
     * @param Array $data An associative array containing the data
     * that should be passed to the view.
     */
    public function render($view, $data, $print=true){
        $filePath = VIEWS_DIR . "/" . $view . ".php";

        $output = NULL;
        if (file_exists($filePath)){
            // Extract the variables to a local namespace
            extract($data);

            // Start output buffering
            ob_start();

            // Include the template file
            include $filePath;

            // End buffering and return its contents
            $output = ob_get_clean();
        }
        if ($print) {
            print $output;
        }
        return $output;
    }
}
