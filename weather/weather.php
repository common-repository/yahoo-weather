<?php
$unit=$_GET['unit'];
$places=$_GET['places'];
$cachetime=$_GET['cachetime'];
include "../simple_html_dom/simple_html_dom.php";

if ($unit=="Celsius") {
$unitformat=" &deg;C";
}

if ($unit=="Fahrenheit") {
$unitformat=" &deg;F";
}

if (empty($unit)) {
$unit="Celsius";
$unitformat=" &deg;C";
}

if (empty($cachetime)) {
$cachetime=300;
}

$unitsafe=strtolower(substr($unit,0,1));

$absolutedirectorypath = str_replace('\\', '/', dirname(__FILE__)); // Absolute path of the directory this file resides in
$relimagedir=str_replace($_SERVER['DOCUMENT_ROOT'], '', $absolutedirectorypath)."/../images/"; // Image path relative to the domain root so it could use relative urls in html

function weather($citycode,$citydisplayname) {
$url="http://weather.yahooapis.com/forecastrss?w=".$citycode."&u=".$GLOBALS['unitsafe'];
if (file_exists("../cache/".md5($url))) {
if(time()-filemtime("../cache/".md5($url))>$GLOBALS['cachetime']) {
$html = file_get_dom("http://weather.yahooapis.com/forecastrss?w=".$citycode."&u=".$GLOBALS['unitsafe']);
file_put_contents("../cache/".md5($url),file_get_contents($url));
} else {
$html = file_get_dom("../cache/".md5($url));
}
} else {
$html = file_get_dom("http://weather.yahooapis.com/forecastrss?w=".$citycode."&u=".$GLOBALS['unitsafe']);
file_put_contents("../cache/".md5($url),file_get_contents($url));
}

$correctwidth=$GLOBALS['width']-32;

echo '<table>';
foreach($html->find('yweather:condition') as $element) {
echo "<tr><td style='vertical-align:middle; width:100%;'>".$citydisplayname."<br /><b>".$element->temp.$GLOBALS['unitformat']."</b></td><td style='vertical-align:middle; width:32px; height:32px;'><img style='width:32px; height:32px;'
src='".$GLOBALS['relimagedir'].$element->code.".png'
alt='".$element->text."' title='".$element->text."'/></td></tr><br />";
}
}
echo '</table>';

$i=0;
$places=explode("<br>",$places);
echo "<span class='yahooweather'><table border='0' width='100%'>";
while($i<count($places)) {
$item=explode("|",$places[$i]);
weather($item[0],htmlspecialchars($item[1]));
$i++;
}
echo "</table></span>";
?>
