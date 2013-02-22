<?php 

//weatherunderground api query
	//try to make the area dynamically change the location.
	// Reference URL: http://www.wunderground.com/weather/api/d/docs?d=data/conditions
	$weather_url = file_get_contents("http://api.wunderground.com/api/55f2cd0398a1022a/conditions/q/19530.json");
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

echo $w_conditions . "<br>";
echo $w_temp_f. "<br>";
echo $w_wind_string . "<br>";

?>
</h2>