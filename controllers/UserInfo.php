<?php
/**
 * Class UserInfo
 *
 * Controller responsible for displaying and updating user information.
 * It fetches the user data from the database and allows the user to modify it.
 * Upon modification, it validates the input data and updates the database with the new values.
 */
require(__ROOT__.'/controllers/Controller.php');
require_once(__ROOT__.'/models/UserDAO.php');
require_once(__ROOT__.'/models/User.php');
session_start();

class UserInfo extends Controller {

    /**
     * Handles the GET request for displaying the user information page.
     *
     * Renders the 'user_info' view which allows users to view and possibly edit their information.
     *
     * @param array<string, mixed> $request An associative array containing the request parameters.
     * @return void
     */
    public function get($request): void {
        $this->render('user_info', []);
    }

    /**
     * Handles the POST request to process and update the user information.
     *
     * Reads and validates the provided input data, checks the user's current password, and then
     * updates the user's information in the database if the data is valid.
     *
     * @return void
     */
    public function post($request): void {
        $email = $request['email'] ?? null;
        $firstName = $request['firstName'] ?? null;
        $lastName = $request['lastName'] ?? null;
        $sexe = $request['sexe'] ?? null;
        $height = $request['height'] ?? null;
        $weight = $request['weight'] ?? null;
        $age = $request['age'] ?? null;
        $pswd = $request['pswd'] ?? null;
        $newPswd = $request['newPswd'] ?? null;

        // Password is required for modifications
        if (!$pswd) {
            $this->render('error', ['message' => 'La modification a échoué. Vous devez renseigné votre mot de passe']);
            return;
        }

        // Instantiate user DAO for database operations
        $dao = UserDAO::getInstance();
        $user = $dao->getUserById($_SESSION['user_id']);

        // Check if the provided email is already in use by another user
        if ($email && $dao->getUserByEmail($email) !== null && $email !== $user->getEmail()) {
            $this->render('error', ['message' => "Votre inscription a échoué. L'email que vous avez insérer est déjà utilisé."]);
            return;
        }

        // Validate the current password and update user attributes
        if ($user->getPswd() === $pswd) {
            if($email !== "") {
                $user->setEmail($email);
            }
            if($firstName !== "") {
                $user->setFirstName($firstName);
            }
            if($lastName !== "") {
                $user->setLastName($lastName);
            }
            if(!is_null($sexe)) {
                $user->setSexe($sexe);
            }
            if((float) $height > 0) {
                $user->setHeight((float) $height);
            }
            if((float) $weight > 0) {
                $user->setWeight((float) $weight);
            }
            if((int) $age > 0) {
                $user->setAge((int)$age);
            }
            if($newPswd !== "") {
                $user->setPswd($newPswd);
            }

            // Attempt to update the user in the database
            try {
                $dao->update($user);
                $this->render('user_info', []);
            } catch (Exception $e) {
                $this->render('error', ['message' => $e->getMessage()]);
            }
        } else {
            $this->render('error', ['message' => 'Mot de passe incorrect.']);
        }
    }
}
