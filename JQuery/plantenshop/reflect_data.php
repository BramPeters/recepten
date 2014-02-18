<?php
//debugbestand om alle GET data te tonen
echo "het GET array bevat de volgende velden:<br />";
echo "============================<br />";
foreach($_GET as $key => $value) {
	if(is_array($value)){
		echo $key . ": (array)<br />";
		foreach($value as $k => $v) {
			 echo str_repeat("&nbsp;", 10). $k . ": " . $v . "<br />";
		}
	}
	else{
	    echo $key . ": " . $value . "<br />";
	}
}
?>