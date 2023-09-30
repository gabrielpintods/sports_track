<?php

/**
 * Class SqliteConnection
 *
 * Manages SQLite database connections using the singleton pattern.
 */
class SqliteConnection {
    /** @var SqliteConnection|null Singleton instance of SqliteConnection */
    private static ?SqliteConnection $instance = null;

    /** @var PDO The PDO connection */
    private PDO $connection;

    /**
     * Constructor
     *
     * Initializes the PDO connection. Private to prevent multiple instances.
     */
    private function __construct() {
        try {
            $this->connection = new PDO('sqlite:./db/sports_track.db');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données SQLite : " . $e->getMessage();
            die();
        }
    }

    /**
     * Get instance of SqliteConnection
     *
     * Implements the singleton pattern to make sure only one SqliteConnection instance exists.
     *
     * @return SqliteConnection Returns the singleton instance of the SqliteConnection class.
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new SqliteConnection();
        }
        return self::$instance;
    }

    /**
     * Get PDO connection
     *
     * @return PDO Returns the PDO connection object.
     */
    public function getConnection() {
        return $this->connection;
    }
}
