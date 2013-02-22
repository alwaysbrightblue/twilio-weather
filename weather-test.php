<?php 

	// Look for the FromCity
	// Read City.  Twilio read the zip as a string.  This sounds better.
	// Reference URL:  https://www.twilio.com/docs/api/twiml/twilio_request
	if(!$citycode = $_REQUEST['FromCity'])
		$citycode = "New York City";
	
	// Look for the FromState
	// Read State for weather api.
	// Reference URL:  https://www.twilio.com/docs/api/twiml/twilio_request
	if(!$statecode = $_REQUEST['FromState'])
		$statecode = "NY";

//weatherunderground api query
	// try to make the area dynamically change the location.
	// Currently, we are not getting the Twilio city/state.  It's pulling the API request as a static element.
	// Reference URL: http://www.wunderground.com/weather/api/d/docs?d=data/conditions
	// Examples of weather_url strings:
	//		to get by zip code: http://api.wunderground.com/api/55f2cd0398a1022a/conditions/q/10036.json
	//		to get by STATE/CITY: http://api.wunderground.com/api/55f2cd0398a1022a/conditions/q/NY/New_York_City.json
	// Since the default location for Twilio is NYC, set the current call info to NYC:
	$weather_url = file_get_contents("http://api.wunderground.com/api/55f2cd0398a1022a/conditions/q/NY/New_York_City.json");
	// I think to dynamically get the state/city I can pass into the html string with something like this: 
	//$weather_url = file_get_contents("http://api.wunderground.com/api/55f2cd0398a1022a/conditions/q/\"'echo $statecode'/\"'echo $citycode'\".json");
	
	
	// once we've got something that works, decode it.
	$weather_output = json_decode($weather_url);
	
	//and then we have to make each element a variable so Twilio can read it
	$w_conditions = $weather_output->current_observation->weather;
	$w_temp_f = $weather_output->current_observation->temp_f;
	$w_wind_string = $weather_output->current_observation->wind_string;
	
	/* TESTING TO SEE THE DATA */
				echo "<pre>";
				print_r($weather_output);
				echo "</pre>";
	


?>

<h2>
<?php 
echo $citycode . "<br>";
echo $statecode . "<br>";
echo $w_conditions . "<br>";
echo $w_temp_f. "<br>";
echo $w_wind_string . "<br>";

?>
</h2>