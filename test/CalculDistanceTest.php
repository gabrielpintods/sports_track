<?php

require '../controllers/CalculDistance.php';

$jsonContent = file_get_contents('./data/test1.json');
$data = json_decode($jsonContent, true);
$jsonContent2 = file_get_contents('./data/test2.json');
$data2 = json_decode($jsonContent2, true);

$locations = [];
foreach ($data['data'] as $entry) {
    $locations[] = [
        'latitude' => $entry['latitude'],
        'longitude' => $entry['longitude']
    ];
}

$locations2 = [];
foreach ($data2['data'] as $entry) {
    $locations2[] = [
        'latitude' => $entry['latitude'],
        'longitude' => $entry['longitude']
    ];
}

$calculDistance = new CalculDistanceImpl();

$distance = $calculDistance->calculDistanceTrajet($locations);
$distance2 = $calculDistance->calculDistanceTrajet($locations2);
echo "Distance du parcours IUT -> RU : " . $distance . " m\n";
echo "Distance du parcours Gym -> Cafe: " . $distance2 . " m\n";
