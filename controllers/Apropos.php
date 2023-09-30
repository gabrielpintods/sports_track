<?php
/**
 * Class Apropos
 *
 * Controller for displaying details about a specific user on the main landing page.
 * The user details are fetched based on the 'user_id' stored in the session.
 */
require(__ROOT__.'/controllers/Controller.php');
require(__ROOT__.'/models/User.php');
require(__ROOT__.'/models/UserDAO.php');

session_start();
class Apropos extends Controller
{

    /**
     * Handles the GET request for displaying the main landing page.
     *
     * Renders the 'apropos' view.
     *
     * @param array $request Associative array containing the request parameters.
     */
    public function get($request): void {
        $user = UserDAO::getInstance()->getUserById($_SESSION['user_id']);
        $userDetails = array(
            "nom" => $user->getFirstName(),
            "prenom" => $user->getLastName(),
            "age" => $user->getAge(),
            "sexe" => $user->getSexe(),
            "poids" => $user->getWeight(),
            "taille" => $user->getHeight(),
            "email" => $user->getEmail(),
            "naissance" => $user->getBirthdate()
        );
        $this->render('apropos', ['userInfo' => $userDetails]);
    }
}