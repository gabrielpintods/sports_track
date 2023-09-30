<?php
/**
 * Class UploadActivityController
 *
 * Controller responsible for handling the upload of user activity data provided in a JSON file format.
 * This allows users to submit their activity-related information which gets stored in the application's database.
 */
session_start();

require_once(__ROOT__.'/models/Activity.php');
require_once(__ROOT__.'/models/ActivityDAO.php');
require(__ROOT__.'/controllers/Controller.php');
require_once(__ROOT__ . '/models/Data.php');
require_once(__ROOT__ . '/models/ActivityEntryDAO.php');
require_once(__ROOT__ . '/models/UserDAO.php');

class UploadActivityController extends Controller {

    /**
     * Handles the GET request.
     *
     * Renders the form that allows users to upload their activity JSON file.
     *
     * @param array<string, mixed> $request An associative array containing the request parameters.
     * @return void
     */
    public function get($request): void{
        $this->render('upload_activity_form', []);
    }

    /**
     * Handles the POST request to process the uploaded activity JSON file.
     *
     * Reads the content of the uploaded file, parses it, validates the JSON data,
     * and then adds the parsed activity and its related data to the database.
     * If the uploaded file or its content is invalid, it renders an error view.
     *
     * @return void
     */
    public function post($request): void {
        // Check if the file upload was successful and there's no error
        if (isset($_FILES['activity_file']) && $_FILES['activity_file']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['activity_file']['tmp_name'];
            $data = file_get_contents($tmp_name);

            // Attempt to decode the JSON content of the uploaded file
            $activityData = json_decode($data, true);

            // If the JSON is valid, process the data
            if (json_last_error() === JSON_ERROR_NONE) {
                $activityDAO = ActivityDAO::getInstance();
                $activityEntryDAO = ActivityEntryDAO::getInstance();

                // Initialize and insert the main activity data
                $activity = new Activity();
                $activity->init(
                    $activityData['activity']['description'],
                    $activityData['activity']['date'],
                    UserDAO::getInstance()->getUserById($_SESSION['user_id'])
                );
                $activityDAO->insert($activity);

                // Loop through each activity entry and insert it
                foreach ($activityData['data'] as $entryData) {
                    $dataEntry = new Data();
                    $dataEntry->init(
                        $entryData['time'],
                        $entryData['cardio_frequency'],
                        $entryData['latitude'],
                        $entryData['longitude'],
                        $entryData['altitude'],
                        $activity
                    );
                    $activityEntryDAO->insert($dataEntry);
                }
                $this->render('upload_activity_form', []);
            } else {
                // Handle invalid JSON content
                $this->render('error_file', ['message' => 'Fichier JSON invalide.']);
            }
        } else {
            // Handle file upload error
            $this->render('error_file', ['message' => 'Échec du téléchargement du fichier.']);
        }
    }
}

