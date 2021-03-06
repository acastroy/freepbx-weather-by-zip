<?php
//
//
//This program is free software; you can redistribute it and/or
//modify it under the terms of the GNU General Public License
//as published by the Free Software Foundation; either version 2
//of the License, or (at your option) any later version.
//
//This program is distributed in the hope that it will be useful,
//but WITHOUT ANY WARRANTY; without even the implied warranty of
//MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//GNU General Public License for more details.

// check to see if user has automatic updates enabled
$cm =& cronmanager::create($db);
$online_updates = $cm->updates_enabled() ? true : false;

// check if new version of module is available
if ($online_updates && $foo = weatherzip_vercheck()) {
	print "<br>A <b>new version</b> of this module is available from the <a target='_blank' href='http://pbxossa.org'>PBX Open Source Software Alliance</a><br>";
}

//tts_findengines()
if(count($_POST)){
	weatheroptions_saveconfig();
}
	$date = weatheroptions_getconfig();
	$selected = ($date[0]);

//  Get current featurecode from FreePBX registry
$fcc = new featurecode('weatherzip', 'weatherzip');
$featurecode = $fcc->getCodeActive(); 

?>
<form method="POST" action="">
	<br><h2><?php echo _("U.S. Weather by Zipcode")?><hr></h5></td></tr>
Weather by Zip Code allows you to retrieve current weather information from any touchtone phone using nothing more than your PBX connected to the Internet.  When prompted you key your U.S. Zip Code, the report is downloaded, converted to an audio file, and played back to you.<br><br>
Current conditions and/or forecast for the chosen Zip Code will then will be retrieved from the selected service using the selected text-to-speech engine. <br><br>
The feature code to access this service is currently set to <b><?PHP print $featurecode; ?></b>.  This value can be changed in Feature Codes. <br>

<br><h5>User Data:<hr></h5>
Select the Text To Speach engine and Forecast source combination you wish the Weather by Zip program to use.<br>The module does not check to see if the selected TTS engine is present, ensure to choose an engine that is installed on the system.<br><br>
<a href="#" class="info">Choose a service and engine:<span>Choose from the list of supported TTS engines and weather services</span></a>

<select size="1" name="engine">
<?php
echo "<option".(($date[0]=='noaa-flite')?' selected':'').">noaa-flite</option>\n";
//echo "<option".(($date[0]=='noaa-swift')?' selected':'').">noaa-swift</option>\n";
echo "<option".(($date[0]=='wunderground-flite')?' selected':'').">wunderground-flite</option>\n";
//echo "<option".(($date[0]=='wunderground-swift')?' selected':'').">wunderground-swift</option>\n";
echo "<option".(($date[0]=='wunderground-googletts')?' selected':'').">wunderground-googletts</option>\n";
?>
</select>
<br><a href="#" class="info">Wunderground API KEY:<span>Input free API key from registration with http://wunderground.com weather service</span></a>
<input type="text" name="wgroundkey" size="27" value="<?php echo $date[1]; ?>">  <a href="javascript: return false;" class="info"> 
<br><br>key:<br>
<b>noaa</b> - National Oceanic and Atmospheric Administration (USA weather service)<br>
<b>wunderground</b> - Weather API provided by wunderground.com<br>
<b>flite</b> - Asterisk Flite Text to Speech Engine<br>
<b>swift</b> - Cepstral Swift Text to Speech Engine<br>
<b>googletts</b> - Google text to speech engine by Lefteris Zafiris<br>
		
<br><br><input type="submit" value="Submit" name="B1"><br>

<center><br>
The module is maintained by the developer community at <a target="_blank" href="http://pbxossa.org"> PBX Open Source Software Alliance</a>.  Support, documentation and current versions are available at the module <a target="_blank" href="https://github.com/POSSA/freepbx-weather-by-zip">dev site</a></center>
<?php
print '<p align="center" style="font-size:11px;">The Weather by Zip and Google Weather scripts were created and are currently maintaned by <a target="_blank" href="http://www.nerdvittles.com">Nerd Vittles</a>.';

?>