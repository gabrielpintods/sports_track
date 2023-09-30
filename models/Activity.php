<?php

/**
 * Class Activity
 * Represents an activity with description, date, and associated user.
 */
class Activity
{
    /** @var int $idActivity Unique identifier for the activity. */
    private int $idActivity;

    /** @var string $desc Description of the activity. */
    private string $desc;

    /** @var string $date Date of the activity. */
    private string $date;

    /** @var User $theUser User associated with the activity. */
    private User $theUser;

    /**
     * Activity constructor.
     */
    public function __construct() {}

    /**
     * Initialize the Activity object with provided parameters.
     *
     * @param string $d   Description of the activity.
     * @param string $da  Date of the activity.
     * @param User   $user User associated with the activity.
     */
    public function init(
        string $d,
        string $da,
        User $user
    ) {
        $this->desc = $d;
        $this->date = $da;
        $this->theUser = $user;
    }

    /**
     * Get the unique identifier of the activity.
     *
     * @return int Unique identifier.
     */
    public function getIdActivity(): int { return $this->idActivity; }

    /**
     * Get the description of the activity.
     *
     * @return string Description.
     */
    public function getDesc(): string { return $this->desc; }

    /**
     * Get the date of the activity.
     *
     * @return string Date.
     */
    public function getDate(): string { return $this->date; }

    /**
     * Get the User associated with the activity.
     *
     * @return User Associated User.
     */
    public function getTheUser(): User { return $this->theUser; }

    /**
     * Set the unique identifier of the activity.
     *
     * @param int $idActivity Unique identifier.
     */
    public function setIdActivity(int $idActivity): void { $this->idActivity = $idActivity; }

    /**
     * Set the description of the activity.
     *
     * @param string $desc Description.
     */
    public function setDesc(string $desc): void { $this->desc = $desc; }

    /**
     * Set the date of the activity.
     *
     * @param string $date Date.
     */
    public function setDate(string $date): void { $this->date = $date; }

    /**
     * Set the User associated with the activity.
     *
     * @param User $theUser Associated User.
     */
    public function setTheUser(User $theUser): void { $this->theUser = $theUser; }

    /**
     * Convert the Activity object to string.
     *
     * @return string String representation of the object.
     */
    public function __toString(): string {
        return "\nActivity [\n"
            . "\tid=" . $this->idActivity
            . "\tDesc=" . $this->desc
            . "\ttheUser=" . $this->theUser->getIdUser() . "\n]\n";
    }
}
