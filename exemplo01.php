<?php

require_once 'Services/OpenStreetMap.php';
$osm = new Services_OpenStreetMap();

$osm->get(-8.3564758, 52.821022799999994, -7.7330017, 53.0428644);
file_put_contents("area_covered.osm", $osm->getXml());

$osm = new Services_OpenStreetMap();

$osm->loadXml("./osm.osm");
$results = $osm->search(array("amenity" => "pharmacy"));
echo "List of Pharmacies\n";
echo "==================\n\n";

foreach ($results as $result) {
    $name = null;
    $addr_street = null;
    $addr_city = null;
    $addr_country = null;
    $addr_housename = null;
    $addr_housenumber = null;
    $opening_hours = null;
    $phone = null;

    extract($result);
    $line1 = ($addr_housenumber) ? $addr_housenumber : $addr_housename;
    if ($line1 != null) {
        $line1 .= ', ';
    }
    echo  "$name\n{$line1}{$addr_street}\n$phone\n$opening_hours\n\n";
}

?>