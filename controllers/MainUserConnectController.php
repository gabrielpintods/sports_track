<?php
/**
 * Class MainUserConnectController
 *
 * Controller responsible for displaying the main landing page post-user connection.
 * Typically, this page would be displayed after a user has successfully logged in or registered.
 */
require(__ROOT__.'/controllers/Controller.php');

class MainUserConnectController extends Controller
{

    /**
     * Handles the GET request to show the landing page for connected users.
     *
     * When users successfully log in or sign up, this method directs them to the main
     * connected page, which might contain user-specific details, navigation options, etc.
     *
     * @param array<string, mixed> $request An associative array containing the request parameters.
     * @return void
     */
    public function get($request): void {
        $this->render('user_main_connect', []);
    }
}