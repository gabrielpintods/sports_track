<?php

/**
 * Class AddUserController
 *
 * Controller for adding new users to the database.
 */
require_once(__ROOT__.'/models/UserDAO.php');
require_once(__ROOT__.'/models/User.php');
require(__ROOT__.'/controllers/Controller.php');

class AddUserController extends Controller {

    /**
     * Handles the GET request for displaying the form to add a new user.
     *
     * Renders the 'user_add_form' view.
     *
     * @param array $request Associative array containing the request parameters.
     */
    public function get($request): void {
        $this->render('user_add_form', []);
    }

    /**
     * Handles the POST request to add a new user.
     *
     * Validates the request data, checks for existing email addresses,
     * and adds the new user to the database.
     *
     * @param array $request Associative array containing the request parameters.
     * @throws Exception if an email already exists
     */
    public function post($request): void {
        $email = $request['email'] ?? null;
        $firstName = $request['firstName'] ?? null;
        $lastName = $request['lastName'] ?? null;
        $sexe = $request['sexe'] ?? null;
        $height = $request['height'] ?? null;
        $weight = $request['weight'] ?? null;
        $oldBirthDate = $request['birthdate'] ?? null;
        $birthdate = date("d/m/Y", strtotime($oldBirthDate));
        $age = $request['age'] ?? null;
        $pswd = $request['pswd'] ?? null;

        // Check if all the fields are not empty
        if (!$email || !$firstName || !$lastName || !$height || !$weight || !$age || !$birthdate || !$pswd || !$sexe) {
            $this->render('error', ['message' => 'Votre inscription a échoué. Tous les champs sont requis.']);
            return;
        }

        // Check if email already exists
        $dao = UserDAO::getInstance();
        if ($dao->getUserByEmail($email) !== null) {
            $this->render('error', ['message' => "Votre inscription a échoué. L'email que vous avez insérer est déjà utilisé."]);
            return;
        }

        // Create a new user
        $user = new User();
        $user->init($email, $firstName, $lastName, $sexe, $height, $weight, $age, $birthdate, $pswd);

        // Insert the user into the database
        try {
            $dao->insert($user);
            $this->render('user_add_valid', []);
        } catch (Exception $e) {
            $this->render('error', ['message' => $e->getMessage()]);
        }
    }
}
