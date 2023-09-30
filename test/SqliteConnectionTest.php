<?php

require_once('./models/User.php');
require_once('./models/UserDAO.php');
require_once('./models/Activity.php');
require_once('./models/ActivityDAO.php');
require_once('./models/Data.php');
require_once('./models/ActivityEntryDAO.php');
require_once './models/SqliteConnection.php';

class SqliteConnectionTest {

    public function runTests(): void {
        echo "Début des tests...\n";
        $this->deleteAllData();

        // Test Insertion
        echo "\n======== UserDAO test ========\n";
        echo "\nTest insert() && __toString()\n";
        $user1 = new User();
        $user1->init("john.doe@example.com", "John", "Doe", "homme",180, 75, 30, "01/01/1970", "password123");
        UserDAO::getInstance()->insert($user1);
        echo "Utilisateur inséré : " . $user1;

        $user2 = new User();
        $user2->init("jane.doe@example.com", "Jane", "Doe", "femme",165, 60, 28, "01/05/2000", "password456");
        UserDAO::getInstance()->insert($user2);
        echo "Utilisateur inséré : " . $user2;

        // Test Fetch
        echo "\n\nTest findAll()\n";
        $users = UserDAO::getInstance()->findAll();
        foreach($users as $u) {
            echo $u;
        }

        // Test Update
        echo "\nTest update()\n";
        $user1->setEmail("john.updated@example.com");
        $user1->setHeight(182);
        UserDAO::getInstance()->update($user1);
        if($user1->getEmail() == "john.updated@example.com" && $user1->getHeight() == 182) {
            echo "OK\n";
        } else {
            echo "ERREUR\n";
        }

        $user2->setAge(29);
        $user2->setWeight(62);
        UserDAO::getInstance()->update($user2);
        if($user2->getAge() == 29 && $user2->getWeight() == 62) {
            echo "OK\n";
        } else {
            echo "ERREUR\n";
        }

        // Test Delete & Update
        echo "\nTest delete()\n";
        UserDAO::getInstance()->delete($user1);
        try {
            UserDAO::getInstance()->update($user1);
            echo "ERREUR\n";
        } catch (Exception $e) {
            echo "OK\n";
        }

        // Test getUserById
        echo "\nTest getUserById()\n";
        $user = UserDAO::getInstance()->getUserById($user2->getIdUser());
        if ($user != null) {
            echo "OK = Utilisateur trouvé: " . $user->getIdUser() ."\n";
        } else {
            echo "Aucun utilisateur trouvé pour cet ID \n";
        }

        // Test emailExists when it does not exists
        echo "\nTest getUserByEmail()\n";
        $user3 = new User();
        $user3->init("gab.test@example.com", "John", "Doe", "homme",180, 75, 30, "01/05/2000", "password123");
        UserDAO::getInstance()->insert($user3);
        if(UserDAO::getInstance()->getUserByEmail("gab.test@example.com")->getEmail() == $user3->getEmail()) {
            echo "OK\n";
        } else {
            echo "ERREUR\n";
        }

        UserDAO::getInstance()->delete($user2);
        UserDAO::getInstance()->delete($user1);
        UserDAO::getInstance()->delete($user3);

        // Tests pour ActivityDAO
        echo "\n======== ActivityDAO test ========\n";
        $user1 = new User();
        $user1->init("john.doe@example.com", "John", "Doe", "homme",180, 75, 30, "01/05/2000", "password123");
        UserDAO::getInstance()->insert($user1);
        $user2 = new User();
        $user2->init("jane.doe@example.com", "Jane", "Doe", "femme",160, 60, 30, "01/05/2001", "password123");
        UserDAO::getInstance()->insert($user2);

        // Test Insertion
        echo "\nTest insert() && toString()\n";
        $activity1 = new Activity();
        $activity1->init("Description 1", "18/05/2023", $user1);
        ActivityDAO::getInstance()->insert($activity1);
        echo "Activité insérée : " . $activity1;

        $activity2 = new Activity();
        $activity2->init("Description 2", "18/05/2023", $user2);
        ActivityDAO::getInstance()->insert($activity2);
        echo "Activité insérée : " . $activity2;

        // Test Fetch
        echo "\n\nTest findAll()\n";
        $activities = ActivityDAO::getInstance()->findAll();
        foreach($activities as $act) {
            echo $act . "\n]";
        }

        // Test Delete & Update
        echo "\nTest delete() & update()\n";
        $activity1->setDesc("Description mise à jour");
        ActivityDAO::getInstance()->update($activity1);
        ActivityDAO::getInstance()->delete($activity1);
        try {
            ActivityDAO::getInstance()->update($activity1);
            echo "ERREUR\n";
        } catch (Exception $e) {
            echo "OK\n";
        }

        // Test getActivityById
        echo "\nTest getActivityById()\n";
        $act = ActivityDAO::getInstance()->getActivityByID($activity2->getIdActivity());
        if ($act != null) {
            echo "Activité trouvé: " . $act->getIdActivity();
        } else {
            echo "Aucune activité trouvé pour cet ID";
        }


        // Tests pour ActivityEntryDAO
        echo "\n\nTests pour ActivityEntryDAO\n";
        $activity1 = new Activity();
        $activity1->init("Description 1", "18/05/2023", $user1);
        ActivityDAO::getInstance()->insert($activity1);
        echo "Activité insérée : " . $activity1;

        // Test Insertion
        echo "\nTest insert()\n";
        $activityEntry1 = new Data();
        $activityEntry1->init("12:00:00", 90, 48.8566, 2.3522, 35, $activity1);
        ActivityEntryDAO::getInstance()->insert($activityEntry1);
        echo "Entrée d'activité insérée : " . $activityEntry1;

        $activityEntry2 = new Data();
        $activityEntry3 = new Data();
        $activityEntry4 = new Data();
        $activityEntry5 = new Data();
        $activityEntry2->init("13:00:00", 95, 48.8577, 2.3533, 40, $activity2);
        ActivityEntryDAO::getInstance()->insert($activityEntry2);
        echo "Entrée d'activité insérée : " . $activityEntry2;

        $activityEntry3->init("13:00:05", 95, 48.978, 2.987, 40, $activity2);
        $activityEntry4->init("13:00:10", 95, 48.98798, 2.978, 40, $activity2);
        $activityEntry5->init("13:00:20", 95, 49.121, 2.6, 40, $activity2);
        ActivityEntryDAO::getInstance()->insert($activityEntry3);
        ActivityEntryDAO::getInstance()->insert($activityEntry4);
        ActivityEntryDAO::getInstance()->insert($activityEntry5);

        // Test Fetch
        echo "\n\nTest findAll()\n";
        $activityEntries = ActivityEntryDAO::getInstance()->findAll();
        foreach($activityEntries as $actEntry) {
            echo $actEntry . "\n";
        }

        // Test getDurationFromActivity
        echo "\nTest getDurationFromActivity\n";
        $act = ActivityDAO::getInstance()->getDurationFromActivity($activity2);
        echo $act;


        // Test getStartingTimeFromActivity
        echo "\nTest getStartingTimeFromActivity()\n";
        $act = ActivityDAO::getInstance()->getStartingTimeFromActivity($activity2);
        echo $act;

        // Test getEndingTimeFromActivity
        echo "\nTest getEndingTimeFromActivity()\n";
        $act = ActivityDAO::getInstance()->getEndingTimeFromActivity($activity2);
        echo $act;


        // Test Delete & Update
        echo "\nTest delete() & update()\n";
        $activityEntry1->setTime("12:30:00");
        ActivityEntryDAO::getInstance()->update($activityEntry1);
        ActivityEntryDAO::getInstance()->delete($activityEntry1);
        try {
            ActivityEntryDAO::getInstance()->update($activityEntry1);
            echo "ERREUR\n";
        } catch (Exception $e) {
            echo "OK\n";
        }
        $this->deleteAllData();
        echo "\nFin des tests.\n";
    }

    /**
     * Supprime toutes les données des tables
     */
    private function deleteAllData(): void {
        try {
            $dbc = SqliteConnection::getInstance()->getConnection();

            $dbc->exec('DELETE FROM User');
            $dbc->exec('DELETE FROM Activity');
            $dbc->exec('DELETE FROM Data');
            echo "Toutes les données ont été supprimées.\n";
        } catch (Exception $e) {
            echo "Erreur lors de la suppression de toutes les données : " . $e->getMessage() . "\n";
        }
    }
}

$test = new SqliteConnectionTest();
$test->runTests();
