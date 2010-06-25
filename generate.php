<?php

function sanitise($input)
{
	return $input;
}

$latitude = sanitise($_GET['latitude']);
$longitude = sanitise($_GET['longitude']);

