<?php
/**
 * Class ListActivityController
 *
 * Controller for managing the listing of user activities.
 */
require(__ROOT__.'/controllers/Controller.php');
require_once(__ROOT__.'/models/ActivityDAO.php');
require_once(__ROOT__.'/models/ActivityEntryDAO.php');
require_once(__ROOT__.'/models/UserDAO.php');
require_once(__ROOT__.'/controllers/CalculDistance.php');
require_once(__ROOT__.'/models/Data.php');

class ListActivityController extends Controller {

    /**
     * Handles the GET request to retrieve and list all activities for the currently logged-in user.
     *
     * Fetches all activities and associated details such as duration, distance, and heart rate for
     * the currently logged-in user and then renders the activities list view.
     *
     * @param array<string, mixed> $request An associative array containing the request parameters.
     * @return void
     */
    public function get($request): void {
        // Create an instance of the distance calculation implementation
        $calculate = new CalculDistanceImpl();

        // Start or resume session
        session_start();

        // Check if a user is logged in
        if (!isset($_SESSION['user_id'])) {
            $this->render('error', ["message" => "Veuillez vous connecter pour voir vos activités."]);
            return;
        }

        // Fetch the current user from the database
        $user = UserDAO::getInstance()->getUserById($_SESSION['user_id']);

        // Fetch all activities for the current user
        $activities = ActivityDAO::getInstance()->getActivityFromUser(($user));

        // Initialize an empty array to store detailed activity information
        $activitiesDetails = array();

        // Loop through each activity and fetch associated details
        foreach ($activities as $activity) {
            $details = array(
                "description" => $activity->getDesc(),
                "date" => $activity->getDate(),
                "startTime" => ActivityDAO::getInstance()->getStartingTimeFromActivity($activity),
                "endTime" => ActivityDAO::getInstance()->getEndingTimeFromActivity($activity),
                "duration" => ActivityDAO::getInstance()->getDurationFromActivity($activity),
                "averageHeartRate" => ActivityDAO::getInstance()->getAverageCardioFreqFromActivity($activity),
                "distance" => $calculate->calculDistanceTrajet(
                    ActivityDAO::getInstance()->getCoordinatesFromActivity($activity)),
                "altitude" => ActivityDAO::getInstance()->getDeniveleFromActivity($activity)
            );

            // Add the activity details to the list
            $activitiesDetails[] = $details;
        }

        // Render the activities list view with the fetched data
        $this->render('list_activities', ['data' => $activitiesDetails]);
    }
}

