<?php
	header("HTTP/1.1 200 OK");
	header("Status: 200 OK");
	header("Content-Type: text/html; charset=UTF-8");
	
	// get latitude or longitude from the "map_url" node
	function getCoordonates($link, $type) {
		preg_match('/@(\-?[0-9]+\.[0-9]+),(\-?[0-9]+\.[0-9]+)/', $link, $matches);
		switch ($type) {
		    case "latitude":
		        $result = (float)$matches[1];
		        break;
		    case "longitude":
		        $result = (float)$matches[2];
		        break;
		    default:
		       $result = "N / A";
		}
		return $result;
	}
	
	// read the xml source as string
  	$xml_content = file_get_contents("countries.xml");
	
	// load the string as xml object
  	$countries = @simplexml_load_string($xml_content) or die('Error: failed loading XML');
	
  	// initialize the return array
  	$allCountries = array();
  	  	  	
	// parse the xml nodes
	foreach ($countries as $country) {
		
		$mapArray = array(
			"region" => (string) $country["zone"],
			"country" => ucFirst((string) $country -> name). " <i>(".ucFirst((string) $country -> name["native"]).")</i>",
			"language" => ucFirst((string) $country -> language). " <i>(".ucFirst((string) $country -> language["native"]).")</i>",
			"currency" => ucFirst($country -> currency). " <i>(".ucFirst((string) $country -> currency["code"]).")</i>",
			"latitude" => getCoordonates((string) $country -> map_url, "latitude"),
			"longitude" => getCoordonates((string) $country -> map_url, "longitude")
		);
		array_push($allCountries, $mapArray);
	}
	
	// order ascendent the countries array by region
	$sorted_countries = array();
    foreach ($allCountries as $key => $row) {
	    $sorted_countries[$key] = $row['region'];
	}
	array_multisort($sorted_countries, SORT_ASC, $allCountries);
	
	/**
	  * get only the countries thats have the euro currency
	  * using the XPath syntax
	*/
	$euro_countries = array(
      	'currency' => '/countries/country/currency',
      	'country_name' => '/countries/country/name'
    );
    
    // initialize the return array
	$all_euro_countries = array();
	
  // parse the xml nodes
  foreach($euro_countries as $key => $xpath) {
    $values = $countries->xpath("{$xpath}");
    foreach($values as $value) {
	   
      $all_euro_countries[$key][] = (string)$value;

    }
  }

  // print the return array
  /*
  print '<pre>';
  print_r($values);
  print '</pre>';
  */
?>
<!DOCTYPE html>
<html>
<head>
<title>XML Parser In PHP</title>
<style type="text/css">
    .divTable { display: table; width: auto; padding: 5px; }

    .headRow { text-align: left; font-weight: 700; }
    
    .divRow { display: table-row; width: auto; }

    .divCell { float:left; display: table-cell; width: 200px; border: 1px solid #333; padding: 5px; }
</style>
</head>
<body>
<div class="divTable">
	<fieldset>
		<legend>Region:</legend>
		<select onchange="filterResults(this);">
		  <option value="">-- choose --</option>
		  <option value="western">Western</option>
		  <option value="central">Central</option>
		  <option value="eastern">Eastern</option>
		</select>
	</fieldset>
	<div class="headRow">
    	<div class="divCell" align="center">Region</div>
    	<div class="divCell">Country</div>
    	<div class="divCell">Language</div>
    	<div class="divCell">Currency</div>
    	<div class="divCell">Latitudine</div>
    	<div class="divCell">Longitudine</div>
 	</div>
<?php
	$i = 0;
	while ($i < count($allCountries)) {
		echo '<div class="divRow">'."\n";
		echo '	<div class="divCell">'.$allCountries[$i]['region'].'</div>'."\n";
		echo '	<div class="divCell">'.$allCountries[$i]['country'].'</div>'."\n";
		echo '	<div class="divCell">'.$allCountries[$i]['language'].'</div>'."\n";
		echo '	<div class="divCell">'.$allCountries[$i]['currency'].'</div>'."\n";
		echo '	<div class="divCell">'.$allCountries[$i]['latitude'].'</div>'."\n";
		echo '	<div class="divCell">'.$allCountries[$i]['longitude'].'</div>'."\n";
		echo '</div>'."\n";
		$i++;
	} 
?>	
</div>
<div>
	<p>Countries that have the "Euro" currency are:</p>
</div>

<script>
function filterResults(option) {
  var tblRow = document.getElementsByClassName("divRow");
  
  // Loop through all table rows, and hide those who don't match the search query
  for (var i = 0; i < tblRow.length; i++) {
	  var tblColumn = tblRow[i].getElementsByClassName("divCell")[0];
	  if (option.value != "") {
		  if (tblColumn.innerText == option.value) {
		  	tblRow[i].style.display = "";
	  	  } else {
          	tblRow[i].style.display = "none";
      	  }
      } else {
	      tblRow[i].style.display = "";
  	  }
  }
}
</script>
</body>
</html>
	