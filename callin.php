<?php 

	// What does this do?  
	// Call Twilio Number 401-441-6954.  Twilio will look for 'FromZip' and respond with the current weather. 
	// If your location is not available, just say read the weather for New York City.

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
	// This thread on Stackoverflow might be helpful: http://stackoverflow.com/questions/1485031/looping-and-file-get-contents-in-php?rq=1
	// Set the host:
	$host = "http://api.wunderground.com/api/55f2cd0398a1022a/conditions/q/";
	// q is followed by the state then the city.  We already got these above from Twilio.
	// Reference URL: http://www.wunderground.com/weather/api/d/docs?d=data/conditions
	// Examples of weather_url strings:
	//		to get by zip code: http://api.wunderground.com/api/55f2cd0398a1022a/conditions/q/10036.json
	//		to get by STATE/CITY: http://api.wunderground.com/api/55f2cd0398a1022a/conditions/q/NY/New_York_City.json
	
	// so, let\s build this dyamically
	$slash = "/";
	$json = ".json";
	// final api request:
	if(!$weather_url = file_get_contents($host . "/"  . $statecode . "/" . $citycode . $json))
		// Since the default location for Twilio is NYC, set the current call info to NYC:
		$weather_url = file_get_contents("http://api.wunderground.com/api/55f2cd0398a1022a/conditions/q/NY/New_York_City.json");
	
	// once we've got something that works, decode it.
	$weather_output = json_decode($weather_url);
	
	//and then we have to make each element a variable so Twilio can read it
	$w_conditions = $weather_output->current_observation->weather;
	$w_temp_f = $weather_output->current_observation->temp_f;
	$w_wind_string = $weather_output->current_observation->wind_string; 	   
	
	/* TESTING TO SEE THE DATA */
				//echo "<pre>";
				//print_r($weather_output);
				//echo "</pre>";
	
	header("content-type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>

<Response>
	<Say voice="woman">The weather for <?php echo $citycode ?> is currently <?php echo $w_conditions ?> with a temperature of <?php echo $w_temp_f ?> with winds <?php echo $w_wind_string ?>. Enjoy your day! Good-bye!</Say>
</Response>