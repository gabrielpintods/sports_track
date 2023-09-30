<?php
/**
 * Class MainController
 *
 * Controller for handling the main landing page.
 */
require(__ROOT__.'/controllers/Controller.php');

class Main extends Controller
{

    /**
     * Handles the GET request for displaying the main landing page.
     *
     * Renders the 'main' view.
     *
     * @param array $request Associative array containing the request parameters.
     */
    public function get($request): void {
        $this->render('main', []);
    }
}