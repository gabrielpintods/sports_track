<?php
require_once('SqliteConnection.php');
require_once('Activity.php');

/**
 * Class ActivityDAO
 *
 * Data Access Object for Activity entities.
 */
class ActivityDAO {
    /** @var ActivityDAO Singleton instance of ActivityDAO */
    private static ActivityDAO $dao;

    /**
     * Private constructor to enforce Singleton pattern.
     */
    private function __construct() {}

    /**
     * Get instance of ActivityDAO
     *
     * @return ActivityDAO Singleton instance of ActivityDAO
     */
    public static function getInstance(): ActivityDAO {
        if(!isset(self::$dao)) {
            self::$dao= new ActivityDAO();
        }
        return self::$dao;
    }

    /**
     * Retrieve all Activity records sorted by date.
     *
     * @return array Array of Activity objects
     */
    public final function findAll(): array {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Activity order by date DESC";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $activities = [];
        foreach ($results as $row) {
            $activity = new Activity();
            $activity->setIdActivity($row['idActivity']);
            $activity->setDesc($row['desc']);
            $activity->setDate($row['date']);
            $activity->setTheUser(UserDAO::getInstance()->getUserById($row['theUser']));
            $activities[] = $activity;
        }
        return $activities;
    }

    /**
     * Insert a new Activity record.
     *
     * @param Activity $st The Activity object to insert
     */
    public final function insert(Activity $st): void{
        $dbc = SqliteConnection::getInstance()->getConnection();
        // prepare the SQL statement
        $query = "insert into Activity(desc, date, theUser) values (:d, :da, :usr);";
        $stmt = $dbc->prepare($query);

        // bind the parameters
        $stmt->bindValue(':d',$st->getDesc());
        $stmt->bindValue(':da',$st->getDate());
        $stmt->bindValue(':usr',$st->getTheUser()->getIdUser(),PDO::PARAM_INT);

        // execute the prepared statement
        $stmt->execute();
        $id = $dbc->lastInsertId();
        $st->setIdActivity($id);
    }

    /**
     * Delete an Activity record.
     *
     * @param Activity $obj The Activity object to delete
     * @throws Exception if deletion fails
     */
    public function delete(Activity $obj): void {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "delete from Activity where idActivity = :id";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':id', $obj->getIdActivity(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception( "Erreur lors de la suppression : " . $e->getMessage() . "\n");
        }
    }

    /**
     * Update an existing Activity record.
     *
     * @param Activity $obj The Activity object to update
     * @throws Exception if update fails or Activity not found
     */
    public function update(Activity $obj): void {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "update Activity set desc = :d, date = :da, theUser = :usr where idActivity = :id";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':id', $obj->getIdActivity(), PDO::PARAM_INT);
            $stmt->bindValue(':d', $obj->getDesc());
            $stmt->bindValue(':da', $obj->getDate());
            $stmt->bindValue(':usr', $obj->getTheUser()->getIdUser(),PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() === 0) {
                throw new Exception("Aucun activity avec l'ID " . $obj->getIdActivity()
                    . " trouvé dans la base de données.");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Retrieve all Activity records associated with a specific User.
     *
     * @param User $obj The User object
     * @return array Array of Activity objects
     */
    public function getActivityFromUser(User $obj): Array {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Activity where theUser = :id";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':id',$obj->getIdUser(),PDO::PARAM_INT);
        $stmt->execute();
        $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ret = array();
        foreach ($activities as $id) {
            $ret[] = ActivityDAO::getInstance()->getActivityByID($id['idActivity']);
        }
        return $ret;
    }

    /**
     * Retrieve an Activity by its ID.
     *
     * @param int $id The ID of the Activity
     * @return Activity The Activity object
     */
    public function getActivityByID(int $id): Activity {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from activity where idActivity = :id";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $activity = new Activity();
        $activity->setIdActivity($row['idActivity']);
        $activity->setDesc($row['desc']);
        $activity->setDate($row['date']);
        $activity->setTheUser(UserDAO::getInstance()->getUserById($row['theUser']));
        return $activity;
    }

    /**
     * Calculate the duration of a given activity.
     *
     * @param Activity $activity The activity whose duration is to be calculated
     * @return string Duration in the format 'HH:MM:SS'
     */
    public function getDurationFromActivity(Activity $activity): string {
        $startTime = $this->getStartingTimeFromActivity($activity);
        $endTime = $this->getEndingTimeFromActivity($activity);

        $startInSeconds = $this->convertTimeToSeconds($startTime);
        $endInSeconds = $this->convertTimeToSeconds($endTime);

        $durationInSeconds = $endInSeconds - $startInSeconds;

        // Convert duration back to HH:MM:SS format
        $hours = floor($durationInSeconds / 3600);
        $minutes = floor(($durationInSeconds % 3600) / 60);
        $seconds = $durationInSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    /**
     * Retrieve the coordinates associated with a given activity.
     *
     * @param Activity $activity The Activity object
     * @return array Array of coordinates with longitude and latitude
     */
    public function getCoordinatesFromActivity(Activity $activity): array {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT longitude, latitude FROM Data WHERE theActivity = :id";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':id', $activity->getIdActivity(), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the starting time of a given activity.
     *
     * @param Activity $activity The Activity object
     * @return string Starting time in the format 'HH:MM:SS'
     * @throws Exception If no data is found for the activity
     */
    public function getStartingTimeFromActivity(Activity $activity): string {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT time FROM Data WHERE theActivity = :id ORDER BY time ASC LIMIT 1";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':id', $activity->getIdActivity(), PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['time'];
        } else {
            throw new Exception("No data found for the given activity.");
        }
    }

    /**
     * Get the ending time of a given activity.
     *
     * @param Activity $activity The Activity object
     * @return string Ending time in the format 'HH:MM:SS'
     * @throws Exception If no data is found for the activity
     */
    public function getEndingTimeFromActivity(Activity $activity): string {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT time FROM Data WHERE theActivity = :id ORDER BY time DESC LIMIT 1";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':id', $activity->getIdActivity(), PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['time'];
        } else {
            throw new Exception("No data found for the given activity.");
        }
    }

    /**
     * Calculate the average cardio frequency of a given activity.
     *
     * @param Activity $activity The Activity object
     * @return int Average cardio frequency
     */
    public function getAverageCardioFreqFromActivity(Activity $activity): int {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT cardioFrequency FROM Data WHERE theActivity = :id";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':id', $activity->getIdActivity(), PDO::PARAM_INT);
        $stmt->execute();
        $allCardioFreq = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $allCardioFreqValues = array_column($allCardioFreq, 'cardioFrequency');

        return (int) round(array_sum($allCardioFreqValues) / count($allCardioFreqValues));
    }

    /**
     * Calculate the difference in altitude (denivelé) of a given activity.
     *
     * @param Activity $activity The Activity object
     * @return string Difference in altitude with a '+' or '-' prefix
     */
    public function getDeniveleFromActivity(Activity $activity): string {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT altitude FROM Data WHERE theActivity = :id";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':id', $activity->getIdActivity(), PDO::PARAM_INT);
        $stmt->execute();
        $allAltitude = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $allAltitudeValues = array_column($allAltitude, 'altitude');
        $maxAltitude = max($allAltitudeValues);
        $minAltitude = min($allAltitudeValues);
        $denivele = $maxAltitude - $minAltitude;
        if($denivele > 0) {
            $ret = '+'.$denivele;
        } else {
            $ret = '-'.$denivele;
        }
        return $ret;
    }

    /**
     * Convert a time string to seconds.
     *
     * @param string $time Time in the format 'HH:MM:SS'
     * @return int The total time in seconds
     */
    private function convertTimeToSeconds(string $time): int {
        $parts = explode(':', $time);
        if (count($parts) !== 3) {
            // Handle the error case. For this example, returning 0.
            return 0;
        }
        $hours = (int) $parts[0];
        $minutes = (int) $parts[1];
        $seconds = (int) $parts[2];

        return ($hours * 3600) + ($minutes * 60) + $seconds;
    }
}
