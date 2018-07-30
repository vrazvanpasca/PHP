<?php

require ("Entities/CoffeeEntity.php");
class CoffeeModel
{
   function GetCoffeeTypes()
   {
   	require 'Credentials.php';

   	mysql_connect($host,$user,$passwd) or die(mysql_error());
   	mysql_select_db($database);
   	$result = mysql_query("SELECT DISTINCT type FROM coffee") or die(mysql_error());
   	$types = array();

   	while($row = mysql_fetch_array($result))
   	{
   		array_push($types,$row[0]);
   	}

   	mysql_close();
    return $types;
   }

   funtion GetCoffeeByType($type)
   {
   	require 'Credentials.php';
     mysql_connect($host,$user,$passwd) or die(mysql_error());
   	mysql_select_db($database);

   	$query = "SELECT * FROM coffee WHERE type LIKE '$type'";
   	$result = mysql_query($query) or die(mysql_error());
   	$coffeeArray = array();

   	while($row = mysql_fetch_array($result))
   	{
   		$name = $row[1];
   		$type = $row[2];
   		$price = $row[3];
   		$roast = $row[4];
   		$country = $row[5];
   		$image = $row[6];
   		$review = $row[7];

   		$coffee = new CoffeeEntity(-1,$name,$type,$price,$roast,$country,$image,$review);
   		array_push($coffeeArray,$coffee);

   		mysql_close();
   		return $coffeeArray;

   	}

   }
}

?>