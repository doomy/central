<?php

namespace Helpers;

use GeoTools;
use model\Place;

class MockGeoTools extends GeoTools {
	const MAX_LAT = 60;
	const MAX_LNG = 122;


	public function getLatLngFromPlace(Place $place) {
		$rand_lat = rand(0, self::MAX_LAT*100000000) / 100000000;
		$rand_lng = rand(0, self::MAX_LNG*100000000) / 100000000;
		return array($rand_lat, $rand_lng);
	}
}