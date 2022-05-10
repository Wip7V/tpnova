
<?php

function DistanciaLinealCoord($olat,$olong,$dlat,$dlong){	
	$dist = 6371 * acos(
	sin(deg2rad($dlat)) * sin(deg2rad($olat)) 
	+ cos(deg2rad($dlong - $olong)) * cos(deg2rad($dlat)) * cos(deg2rad($olat)));
    return $dist;
}

echo DistanciaLinealCoord(41.1188827, 1.2444908999999598, 41.2854449, 1.249458900000036);

?>
