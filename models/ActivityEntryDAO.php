<?php
require_once('SqliteConnection.php');
require_once('Data.php');


/**
 * Class ActivityEntryDAO
 *
 * Data Access Object for ActivityEntry entities.
 */
class ActivityEntryDAO {
    /** @var ActivityEntryDAO Singleton instance of ActivityEntryDAO */
    private static ActivityEntryDAO $dao;

    /**
     * Private constructor to enforce Singleton pattern.
     */
    private function __construct() {}

    /**
     * Get instance of ActivityEntryDAO
     *
     * @return ActivityEntryDAO Singleton instance of ActivityEntryDAO
     */
    public static function getInstance(): ActivityEntryDAO {
        if(!isset(self::$dao)) {
            self::$dao= new ActivityEntryDAO();
        }
        return self::$dao;
    }

    /**
     * Retrieve all Data records.
     *
     * @return array Array of Data objects
     */
    public final function findAll(): Array{
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Data";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $datas = [];
        foreach ($results as $row) {
            $data = new Data();
            $data->setIdData($row['idData']);
            $data->setTime($row['time']);
            $data->setCardioFrequency($row['cardioFrequency']);
            $data->setLongitude($row['longitude']);
            $data->setLatitude($row['latitude']);
            $data->setAltitude($row['altitude']);
            $data->setTheActivity(ActivityDAO::getInstance()->getActivityByID($row['theActivity']));
            $datas[] = $data;
        }

        return $datas;
    }

    /**
     * Insert a new Data record.
     *
     * @param Data $st The Data object to insert
     */
    public final function insert(Data $st): void{
        $dbc = SqliteConnection::getInstance()->getConnection();
        // prepare the SQL statement
        $query = "insert into Data(time, cardioFrequency, latitude, longitude, altitude, theActivity) values (:t,:cf,:lat,:lg,:alt,:act)";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':t',$st->getTime());
        $stmt->bindValue(':cf',$st->getCardioFrequency(),PDO::PARAM_INT);
        $stmt->bindValue(':lat',$st->getLatitude());
        $stmt->bindValue(':lg',$st->getLongitude());
        $stmt->bindValue(':alt',$st->getAltitude());
        $stmt->bindValue(':act',$st->getTheActivity()->getIdActivity(),PDO::PARAM_INT);
        $stmt->execute();
        $id = $dbc->lastInsertId();
        $st->setIdData($id);
    }

    /**
     * Delete a Data record.
     *
     * @param Data $obj The Data object to delete
     * @throws Exception if deletion fails
     */
    public function delete(Data $obj): void {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            // prepare the SQL statement
            $query = "delete from Data where idData = :id";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':id', $obj->getIdData(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erreur lors de la suppression : " . $e->getMessage() . "\n";
        }
    }

    /**
     * Update an existing Data record.
     *
     * @param Data $obj The Data object to update
     * @throws Exception if update fails or Data not found
     */
    public function update(Data $obj): void {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            // prepare the SQL statement
            $query = "update Data set time = :t, cardioFrequency = :cf, latitude = :lat, longitude = :lg, altitude = :alt where idData = :id";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':id',$obj->getIdData(),PDO::PARAM_INT);
            $stmt->bindValue(':t',$obj->getTime());
            $stmt->bindValue(':cf',$obj->getCardioFrequency(),PDO::PARAM_INT);
            $stmt->bindValue(':lat',$obj->getLatitude());
            $stmt->bindValue(':lg',$obj->getLongitude());
            $stmt->bindValue(':alt',$obj->getAltitude());
            $stmt->execute();
            if ($stmt->rowCount() === 0) {
                throw new Exception("Aucune data avec l'ID " . $obj->getIdData()
                    . " trouvé dans la base de données.");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Retrieve all Data records associated with a specific Activity.
     *
     * @param Data $obj The Data object
     * @return array Array of Data objects
     */
    public function getDataFromActivity(Data $obj): Array {
        $dbc = SqliteConnection::getInstance()->getConnection();
        // prepare the SQL statement
        $query = "select * from Data where theActivity = :id";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':id',$obj->getTheActivity()->getTheUser()->getIdUser(),PDO::PARAM_INT);
        return $stmt->fetchALL(PDO::FETCH_CLASS, 'Data');
    }
}
