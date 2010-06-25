<?php

function sanitise($input)
{
	return htmlentities($input);
}

$latitude = sanitise($_GET['latitude']);
$longitude = sanitise($_GET['longitude']);

$filename = "Location.kml";
$placemark = sanitise($_GET['name']);

$kml = <<<HEAD
<?xml version="1.0" encoding="UTF-8"?>
<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">
<Document>
	<name>{$filename}</name>
	<StyleMap id="msn_ylw-pushpin">
		<Pair>
			<key>normal</key>
			<styleUrl>#sn_ylw-pushpin</styleUrl>
		</Pair>
		<Pair>
			<key>highlight</key>
			<styleUrl>#sh_ylw-pushpin</styleUrl>
		</Pair>
	</StyleMap>
	<Style id="sn_ylw-pushpin">
		<IconStyle>
			<scale>1.1</scale>
			<Icon>
				<href>http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png</href>
			</Icon>
			<hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
		</IconStyle>
		<ListStyle>
		</ListStyle>
	</Style>
	<Style id="sh_ylw-pushpin">
		<IconStyle>
			<scale>1.3</scale>
			<Icon>
				<href>http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png</href>
			</Icon>
			<hotSpot x="20" y="2" xunits="pixels" yunits="pixels"/>
		</IconStyle>
		<ListStyle>
		</ListStyle>
	</Style>
	<Placemark>
		<name>{$placemark}</name>
		<styleUrl>#msn_ylw-pushpin</styleUrl>
		<Point>
			<coordinates>{$latitude},{$longitude},0</coordinates>
		</Point>
	</Placemark>
</Document>
</kml>
HEAD;

header('Content-type: application/vnd.google-earth.kml+xml');
header('Content-Disposition: attachment; filename="Location.kml"');

echo $kml;

