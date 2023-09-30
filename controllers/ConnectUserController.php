<?php
/**
 * Class ConnectUserController
 *
 * Controller for handling user authentication and login functionality.
 */
session_start();
require_once(__ROOT__.'/models/UserDAO.php');
require_once(__ROOT__.'/models/User.php');
require(__ROOT__.'/controllers/Controller.php');

class ConnectUserController extends Controller {

    /**
     * Handle GET request.
     *
     * Renders the form for user connection.
     *
     * @param array $request The request parameters.
     */
    public function get($request): void{
        $this->render('user_connect_form', []);
    }

    /**
     * Handles the POST request for user login.
     *
     * Validates the email and password, checks them against the database,
     * and sets the session variable if the user is authenticated.
     *
     * @param array $request Associative array containing the request parameters.
     */
    public function post($request): void {
        $email = $request['email'] ?? null;
        $password = $request['pswd'] ?? null;

        // Check if both email and password are provided
        if ($email && $password) {
            $userDAO = UserDAO::getInstance();
            // Fetch the user with the provided email from the database
            $user = $userDAO->getUserByEmail($email);

            // If the user exists and the password matches, store the user ID in the session
            if ($user && $user->getPswd() === $password) {
                $_SESSION['user_id'] = $user->getIdUser();
                $this->render('user_connect_valid', []);
                return;
            }
            // If the email or password is incorrect, render an error message
            $this->render('error', ['message' => "Votre connexion à échoué. L'email ou le mot de passe ne correspondent pas."]);
        } else {
            // If either email or password is missing, render an error message
            $this->render('error', ['message' => 'Votre connexion à échoué.']);
        }
    }
}
