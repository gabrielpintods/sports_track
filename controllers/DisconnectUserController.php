<?php
session_start();
require(__ROOT__.'/controllers/Controller.php');
/**
 * Class DisconnectUserController
 *
 * Controller for handling user logout functionality.
 */
class DisconnectUserController extends Controller {

    /**
     * Handles the GET request to logout a user.
     *
     * If a user is logged in, it unsets the user ID from the session and destroys the session.
     * After that, it renders a user logout view.
     *
     * @param array<string, mixed> $request An associative array containing the request parameters.
     * @return void
     */
    public function get($request): void {
        // Check if a user ID is set in the session
        if (isset($_SESSION['user_id'])) {
            // Unset the user ID from the session
            unset($_SESSION['user_id']);
        }
        // Destroy the session
        session_destroy();
        // Render the user logout view
        $this->render('user_disconnect', []);
    }
}
