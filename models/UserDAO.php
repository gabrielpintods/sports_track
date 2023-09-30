<?php
require_once('SqliteConnection.php');
require_once('User.php');
/**
 * Class UserDAO
 * Data Access Object for User entities.
 */
class UserDAO {
    /** @var UserDAO $dao Singleton instance of UserDAO. */
    private static UserDAO $dao;

    /**
     * Private constructor for Singleton pattern.
     */
    private function __construct() {}

    /**
     * Get singleton instance of UserDAO.
     *
     * @return UserDAO Singleton instance.
     */
    public static function getInstance(): UserDAO {
        if(!isset(self::$dao)) {
            self::$dao= new UserDAO();
        }
        return self::$dao;
    }

    /**
     * Find all users.
     *
     * @return array Array of User objects.
     */
    public final function findAll(): array {
        $results = [];
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "select * from User order by firstName, lastName";
            $stmt = $dbc->query($query);
            $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'User');
        } catch (PDOException $e) {
            echo "PDO Error occurred: " . $e->getMessage() . "\n";
        }
        return $results;
    }

    /**
     * Insert a new User into the database.
     *
     * @param User $st The User object to insert.
     */
    public final function insert(User $st): void {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "insert into user(email, firstName, lastName, sexe, height, weight, age, birthdate, pswd) values (:em,:fn,:ln,:sx,:h,:w,:a,:bd,:pwd)";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':em', $st->getEmail());
            $stmt->bindValue(':fn', $st->getFirstName());
            $stmt->bindValue(':ln', $st->getLastName());
            $stmt->bindValue(':sx', $st->getSexe());
            $stmt->bindValue(':h', $st->getHeight(), PDO::PARAM_INT);
            $stmt->bindValue(':w', $st->getWeight(), PDO::PARAM_INT);
            $stmt->bindValue(':a', $st->getAge(), PDO::PARAM_INT);
            $stmt->bindValue(':bd', $st->getBirthdate());
            $stmt->bindValue(':pwd', $st->getPswd());
            $stmt->execute();
            $id = $dbc->lastInsertId();
            $st->setIdUser($id);
        } catch (PDOException $e) {
            throw new PDOException("PDO Error occurred: " . $e->getMessage() . "\n");
        }
    }

    /**
     * Delete a User from the database.
     *
     * @param User $obj The User object to delete.
     */
    public function delete(User $obj): void {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "delete from user where idUser = :id";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':id', $obj->getIduser(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException("PDO Error occurred: " . $e->getMessage() . "\n");
        }
    }

    /**
     * Update a User in the database.
     *
     * @param User $obj The User object to update.
     * @throws PDOException|Exception if pdo excpeption occured
     */
    public function update(User $obj): void {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "update user set email = :em, firstName = :fn, lastName = :ln, sexe = :sx, height = :h, weight = :w, age = :a, 
                birthdate = :bd, pswd = :pwd where idUser = :id";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':id', $obj->getIdUser(), PDO::PARAM_INT);
            $stmt->bindValue(':em', $obj->getEmail());
            $stmt->bindValue(':fn', $obj->getFirstname());
            $stmt->bindValue(':ln', $obj->getLastname());
            $stmt->bindValue(':sx', $obj->getSexe());
            $stmt->bindValue(':h', $obj->getHeight(), PDO::PARAM_INT);
            $stmt->bindValue(':w', $obj->getWeight(), PDO::PARAM_INT);
            $stmt->bindValue(':a', $obj->getAge(), PDO::PARAM_INT);
            $stmt->bindValue(':bd', $obj->getBirthdate());
            $stmt->bindValue(':pwd', $obj->getPswd());
            $stmt->execute();
            if ($stmt->rowCount() === 0) {
                throw new Exception("Aucun utilisateur avec l'ID " . $obj->getIduser()
                    . " trouvé dans la base de données.");
            }
        } catch (PDOException $e) {
            throw new PDOException("PDO Error occurred: " . $e->getMessage() . "\n");
        }
    }

    /**
     * Get a User by its ID.
     *
     * @param int $id The ID of the User.
     * @return User|null The User object.
     */
    public function getUserById(int $id): ?User {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "select * from user where idUser = :id";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetchObject('User');
            if($user !== null) {
                return $user;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new PDOException("PDO Error occurred: " . $e->getMessage() . "\n");
        }
    }

    /**
     * Get a User by its email.
     *
     * @param string $email The email of the User.
     * @return User|null The User object.
     */
    public function getUserByEmail(string $email): ?User {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "select * from user where email = :em";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':em', $email);
            $stmt->execute();
            $user = $stmt->fetchObject('User');
            if ($user !== false) {
                return $user;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new PDOException("PDO Error occurred: " . $e->getMessage() . "\n");
        }
    }
}
