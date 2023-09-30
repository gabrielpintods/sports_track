<?php

/**
 * Class User
 * Represents a user with various personal and account details.
 */
class User
{
    /** @var int $idUser Unique identifier for the user. */
    private int $idUser;

    /** @var string $email Email of the user. */
    private string $email;

    /** @var string $firstName First name of the user. */
    private string $firstName;

    /** @var string $lastName Last name of the user. */
    private string $lastName;

    /** @var string $sexe Sexe of the user. */
    private string $sexe;

    /** @var int $height Height of the user in cm. */
    private int $height;

    /** @var int $weight Weight of the user in kg. */
    private int $weight;

    /** @var int $age Age of the user. */
    private int $age;

    /** @var string $birthdate Birthdate of the user. */
    private string $birthdate;

    /** @var string $pswd Password of the user. */
    private string $pswd;

    /**
     * User constructor.
     */
    public function __construct()
    {
    }

    /**
     * Initialize the User object with provided parameters.
     *
     * @param string $em Email of the user.
     * @param string $fName First name of the user.
     * @param string $lName Last name of the user.
     * @param string $sx Gender of the user.
     * @param int $ht Height of the user.
     * @param int $wt Weight of the user.
     * @param int $ag Age of the user.
     * @param string $bDate Birthdate of the user.
     * @param string $pwd Password of the user.
     */
    public function init(
        string $em,
        string $fName,
        string $lName,
        string $sx,
        int    $ht,
        int    $wt,
        int    $ag,
        string $bDate,
        string $pwd
    )
    {
        $this->email = $em;
        $this->firstName = $fName;
        $this->lastName = $lName;
        $this->sexe = $sx;
        $this->height = $ht;
        $this->weight = $wt;
        $this->age = $ag;
        $this->birthdate = $bDate;
        $this->pswd = $pwd;
    }

    /**
     * Get the unique identifier of the user.
     *
     * @return int Unique identifier.
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * Set the ID of the user.
     *
     * @param int $id The new ID.
     */
    public function setIdUser(int $id): void
    {
        $this->idUser = $id;
    }

    /**
     * Get the unique email of the user.
     *
     * @return string email.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the email of the user.
     *
     * @param string $em The new email.
     */
    public function setEmail(string $em): void
    {
        $this->email = $em;
    }

    /**
     * Get the firstname of the user.
     *
     * @return string firstname.
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set the first name of the user.
     *
     * @param string $fName The new first name.
     */
    public function setFirstName(string $fName): void
    {
        $this->firstName = $fName;
    }

    /**
     * Get the lastname of the user.
     *
     * @return string lastname.
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Set the last name of the user.
     *
     * @param string $lName The new last name.
     */
    public function setLastName(string $lName): void
    {
        $this->lastName = $lName;
    }

    /**
     * Get the sexe of the user.
     *
     * @return string sexe.
     */
    public function getSexe(): string
    {
        return $this->sexe;
    }

    /**
     * Set the sexe of the user.
     *
     * @param string $sx The new sexe.
     */
    public function setSexe(string $sx): void
    {
        $this->sexe = $sx;
    }

    /**
     * Get the height of the user.
     *
     * @return int height.
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Set the height of the user.
     *
     * @param int $ht The new height.
     */
    public function setHeight(int $ht): void
    {
        $this->height = $ht;
    }

    /**
     * Get the weight of the user.
     *
     * @return int weight.
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * Set the weight of the user.
     *
     * @param int $wt The new weight.
     */
    public function setWeight(int $wt): void
    {
        $this->weight = $wt;
    }

    /**
     * Get the age of the user.
     *
     * @return int age.
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * Set the age of the user.
     *
     * @param int $ag The new age.
     */
    public function setAge(int $ag): void
    {
        $this->age = $ag;
    }

    /**
     * Get the birthdate of the user.
     *
     * @return string birthdate.
     */
    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    /**
     * Set the birthdate of the user.
     *
     * @param string $bDate The new birthdate.
     */
    public function setBirthdate(string $bDate): void
    {
        $this->birthdate = $bDate;
    }

    /**
     * Get the password of the user.
     *
     * @return string password.
     */
    public function getPswd(): string
    {
        return $this->pswd;
    }

    /**
     * Set the password of the user.
     *
     * @param string $pwd The new password.
     */
    public function setPswd(string $pwd): void
    {
        $this->pswd = $pwd;
    }

    /**
     * Convert the User object to a string.
     *
     * @return string String representation of the object.
     */
    public function __toString(): string
    {
        return "\nUser [\n"
            . "\tid=" . $this->idUser
            . "\temail=" . $this->email
            . "\tfirstName=" . $this->firstName
            . "\tlastName=" . $this->lastName
            . "\theight=" . $this->height
            . "\tweight=" . $this->weight
            . "\tage=" . $this->age
            . "\tbirthdate=" . $this->birthdate
            . "\tsexe=" . $this->sexe . "\n]\n";
    }
}
