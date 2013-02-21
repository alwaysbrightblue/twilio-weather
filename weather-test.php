<?php 

//weatherunderground api query
	//try to make the area dynamically change the location.
	// Reference URL: http://www.wunderground.com/weather/api/d/docs?d=data/conditions
	$weather_url = file_get_contents("http://api.wunderground.com/api/55f2cd0398a1022a/conditions/q/PA/Kutztown.json");
	$weather_output = json_decode($weather_url);
	
	/* TESTING TO SEE THE DATA */
				echo "<pre>";
				print_r($weather_output);
				echo "</pre>";
	


?>

<h2>
<?php echo $weather_output->weather;?>
<?php echo $weather_output->temp_f;?>
<?php echo $weather_output->wind_string;?>

</h2>
<?php 
/* ASSIGN MY FACEBOOK  */
				$graph_url = file_get_contents('https://graph.facebook.com/jgabriel.lloyd');
				$graph_output = json_decode($graph_url);


			/* TESTING TO SEE THE DATA */
				echo "<pre>";
				print_r($graph_output);
			    echo "</pre>";
				
				// PRINT OUT THE RESULTS */
				echo $graph_output->name . "<br>";
				echo $graph_output->gender . "<br />";
				
				?>