<?php


class GeoTools {
    public function compute_distance(model\Place $place1, model\Place $place2) {
        $distance_in_metres = self::vincentyGreatCircleDistance($place1->latitude, $place1->longtitude, $place2->latitude, $place2->longtitude);
        return $distance_in_metres * 0.000621371192; //miles
    }

    public function getLatLngFromPlace(model\Place $place) {
        $env = Environment::get_env();
        $key = $env->CONFIG['geocoding_api_key'];
        $url = "https://maps.google.com/maps/api/geocode/json?key=$key&address=".urlencode($place->name);

        do {
            $repeat = false;
            $json = @file_get_contents($url);
            if ($json) {
                $jsonDecoded = json_decode($json);
                if (isset($jsonDecoded->error_message)&&($jsonDecoded->error_message == 'You have exceeded your rate-limit for this API.')) {
                    $repeat = true;
                    sleep(1);
                }
                elseif($jsonDecoded->status == 'INVALID_REQUEST' || $jsonDecoded->status == 'ZERO_RESULTS') return false;
                else {
                    $location = $jsonDecoded->results[0]->geometry->location;
                    return array($location->lat, $location->lng);
                }
            }
        } while($repeat);
    }

    private function vincentyGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }
}

?>