<?php

/**
 * Class Data
 * Represents a data point with time, cardio frequency, latitude, longitude, and altitude.
 */
class Data {
    /** @var int $idData Unique identifier for the data point. */
    private int $idData;

    /** @var string $time Time of the data point. */
    private string $time;

    /** @var int $cardioFrequency Cardio frequency at the data point. */
    private int $cardioFrequency;

    /** @var float $latitude Latitude of the data point. */
    private float $latitude;

    /** @var float $longitude Longitude of the data point. */
    private float $longitude;

    /** @var int $altitude Altitude of the data point. */
    private int $altitude;

    /** @var Activity $theActivity Activity associated with the data point. */
    private Activity $theActivity;

    /**
     * Data constructor.
     */
    public function __construct() {}

    /**
     * Initialize the Data object with provided parameters.
     *
     * @param string   $t          Time of the data point.
     * @param int      $cardioFreq Cardio frequency at the data point.
     * @param float    $lat        Latitude of the data point.
     * @param float    $lon        Longitude of the data point.
     * @param int      $alt        Altitude of the data point.
     * @param Activity $act        Activity associated with the data point.
     */
    public function init(
        string $t,
        int $cardioFreq,
        float $lat,
        float $lon,
        int $alt,
        Activity $act
    ) {
        $this->time = $t;
        $this->cardioFrequency = $cardioFreq;
        $this->latitude = $lat;
        $this->longitude = $lon;
        $this->altitude = $alt;
        $this->theActivity = $act;
    }

    /**
     * Get the unique identifier of the data point.
     *
     * @return int Unique identifier.
     */
    public function getIdData(): int {
        return $this->idData;
    }

    /**
     * Get the time of the data point.
     *
     * @return string Time.
     */
    public function getTime(): string {
        return $this->time;
    }

    /**
     * Get the cardio frequency of the data point.
     *
     * @return int Cardio frequency.
     */
    public function getCardioFrequency(): int {
        return $this->cardioFrequency;
    }

    /**
     * Get the latitude of the data point.
     *
     * @return float Latitude.
     */
    public function getLatitude(): float {
        return $this->latitude;
    }

    /**
     * Get the longitude of the data point.
     *
     * @return float Longitude.
     */
    public function getLongitude(): float {
        return $this->longitude;
    }

    /**
     * Get the altitude of the data point.
     *
     * @return int Altitude.
     */
    public function getAltitude(): int {
        return $this->altitude;
    }

    /**
     * Get the associated Activity of the data point.
     *
     * @return Activity Associated Activity.
     */
    public function getTheActivity(): Activity {
        return $this->theActivity;
    }

    /**
     * Set the unique identifier of the data point.
     *
     * @param int $id Unique identifier.
     */
    public function setIdData(int $id): void {
        $this->idData = $id;
    }

    /**
     * Set the time of the data point.
     *
     * @param string $t Time.
     */
    public function setTime(string $t): void {
        $this->time = $t;
    }

    /**
     * Set the cardio frequency of the data point.
     *
     * @param int $cardioFreq Cardio frequency.
     */
    public function setCardioFrequency(int $cardioFreq): void {
        $this->cardioFrequency = $cardioFreq;
    }

    /**
     * Set the latitude of the data point.
     *
     * @param float $lat Latitude.
     */
    public function setLatitude(float $lat): void {
        $this->latitude = $lat;
    }

    /**
     * Set the longitude of the data point.
     *
     * @param float $lon Longitude.
     */
    public function setLongitude(float $lon): void {
        $this->longitude = $lon;
    }

    /**
     * Set the altitude of the data point.
     *
     * @param int $alt Altitude.
     */
    public function setAltitude(int $alt): void {
        $this->altitude = $alt;
    }

    /**
     * Set the associated Activity of the data point.
     *
     * @param Activity $act Associated Activity.
     */
    public function setTheActivity(Activity $act): void {
        $this->theActivity = $act;
    }

    /**
     * Convert the Data object to a string.
     *
     * @return string String representation of the object.
     */
    public function __toString(): string {
        return "Data [\n"
            . "\tidData=" . $this->idData . "\n"
            . "\ttime=" . $this->time . "\n"
            . "\tcardioFrequency=" . $this->cardioFrequency . "\n"
            . "\tlongitude=" . $this->longitude . "\n"
            . "\tlatitude=" . $this->latitude . "\n"
            . "\taltitude=" . $this->altitude . "\n"
            . "\ttheActivity=" . $this->theActivity . "\n]";
    }
}
