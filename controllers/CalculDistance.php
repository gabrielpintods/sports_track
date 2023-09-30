<?php

interface CalculDistance {
    /**
     * Retourne la distance en mètres entre 2 points GPS exprimés en degrés.
     * @param float $lat1 Latitude du premier point GPS
     * @param float $long1 Longitude du premier point GPS
     * @param float $lat2 Latitude du second point GPS
     * @param float $long2 Longitude du second point GPS
     * @return float La distance entre les deux points GPS
     */
    public function calculDistance2PointsGPS(float $lat1, float $long1, float $lat2, float $long2): float;

    /**
     * Retourne la distance en mètres du parcours passé en paramètres. Le parcours est
     * défini par un tableau ordonné de points GPS.
     * @param Array $parcours Le tableau contenant les points GPS
     * @return float La distance du parcours
     */
    public function calculDistanceTrajet(Array $parcours): float;
}

class CalculDistanceImpl implements CalculDistance {

    /**
     * Retourne la distance en mètres entre 2 points GPS exprimés en degrés.
     * @param float $lat1 Latitude du premier point GPS
     * @param float $long1 Longitude du premier point GPS
     * @param float $lat2 Latitude du second point GPS
     * @param float $long2 Longitude du second point GPS
     * @return float La distance entre les deux points GPS
     */
    public function calculDistance2PointsGPS(float $lat1, float $long1, float $lat2, float $long2): float {
        $earthRadius = 6378.137;
        $lat1 = pi() * $lat1 / 180;
        $lat2 = pi() * $lat2 / 180;
        $long1 = pi() * $long1 / 180;
        $long2 = pi() * $long2 / 180;
        return $earthRadius * acos(sin($lat2) * sin($lat1) + cos($lat2) * cos($lat1) * cos($long2-$long1));
    }

    /**
     * Retourne la distance en mètres du parcours passé en paramètres. Le parcours est
     * défini par un tableau ordonné de points GPS.
     * @param Array $parcours Le tableau contenant les points GPS
     * @return float La distance du parcours
     */
    public function calculDistanceTrajet(Array $parcours): float {
        $distance = 0.0;
        for($i = 0; $i < count($parcours) - 1; $i++) {
            $lat1 = $parcours[$i]["latitude"];
            $long1 = $parcours[$i]["longitude"];
            $lat2 = $parcours[$i+1]["latitude"];
            $long2 = $parcours[$i+1]["longitude"];
            $distance += $this->calculDistance2PointsGPS($lat1, $long1, $lat2, $long2);
        }
        return round($distance * 1000);
    }
}
