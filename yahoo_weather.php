<?php
/*
Plugin Name: Yahoo Weather
Plugin URI: http://wordpress.org/extend/plugins/yahoo-weather/
Description: A simple Yahoo Weather widget
Version: 1.3.4
Author: Magnus Kokk

    My plugin is released under the GNU General Public License (GPL)
    http://www.gnu.org/licenses/gpl.txt
*/

// We're putting the plugin's functions in one big function we then
// call at 'plugins_loaded' (add_action() at bottom) to ensure the
// required Sidebar Widget functions are available.

function widget_yahoo_weather_init() {

    // Check to see required Widget API functions are defined...
    if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
        return; // ...and if not, exit gracefully from the script.

    // This function prints the sidebar widget--the cool stuff!
    function widget_yahoo_weather($args) {

        // $args is an array of strings which help your widget
        // conform to the active theme: before_widget, before_title,
        // after_widget, and after_title are the array keys.
        extract($args);

        // Collect our widget's options, or define their defaults.
        $options = get_option('widget_yahoo_weather');
        $title = $options['title'];
        $places = $options['places'];
        $unit = $options['unit'];
        $cachetime = $options['cachetime'];

 // It's important to use the $before_widget, $before_title,
         // $after_title and $after_widget variables in your output.

       echo $before_widget;
        echo $before_title . $title . $after_title;

echo file_get_contents(get_bloginfo("wpurl")."/wp-content/plugins/yahoo-weather/weather/weather.php?places=".$places."&unit=".$unit."&cachetime=".$cachetime);


if (substr(decoct( fileperms(str_replace('\\', '/', dirname(__FILE__))."/cache") ), 2) != "777") {
echo "<b><font color='red'>The directory named 'cache' must be set to 777 in ".str_replace('\\', '/', dirname(__FILE__))."</font></b>";
}
 echo $after_widget;
}

    // This is the function that outputs the form to let users edit
    // the widget's title and so on. It's an optional feature, but
    // we'll use it because we can!

    function widget_yahoo_weather_control() {

        // Collect our widget's options.
        $options = get_option('widget_yahoo_weather');

if (!is_array( $options ))  
{  
$options = array(  
'title' => 'Yahoo Weather',  
'places' => '845743|Tallinn,%20Estonia<br>807392|Győr,%20Hungary<br>487978|Brzesko,%20Poland<br>746203|Porto,%20Portugal<br>753692|Barcelona,%20Spain<br>23388162|Soverato,%20Italy',  
'unit' => 'Celsius',
'cachetime' => 300 
);  
}  

$separators1=array(' ','\n');
$separators2=array('jou',';');

if ($_POST['submit']) {  

$options['title'] = htmlspecialchars($_POST['title']);  
$options['places'] = str_replace("\r\n",'<br>',str_replace(' ','%20',htmlspecialchars($_POST['places']))); 
$options['unit'] = htmlspecialchars($_POST['unit']);  
$options['cachetime'] = htmlspecialchars($_POST['cachetime']); 
update_option("widget_yahoo_weather", $options);  
}  

       // This is for handing the control form submission.
        if ( $_POST['submit'] ) {
            // Clean up control form submission options
            $options['title'] = strip_tags(stripslashes($_POST['title']));
            $options['places'] = strip_tags(stripslashes($_POST['places']));
            $options['unit'] = strip_tags(stripslashes($_POST['unit']));
            $options['cachetime'] = strip_tags(stripslashes($_POST['cachetime']));
        }
   
// The HTML below is the control form for editing options.
?>

        
        <label style="display:block; margin-bottom:10px;" for="title" >Widget title: <input type="text" id="title" name="title" value="<?php echo $options['title']; ?>" /></label>

        <label style="display:block; margin-bottom:10px;" for="places" >Cities to show (<a href="http://woeid.rosselliot.co.nz/" target="_blank">WOEID finder</a>): 
<textarea class="widefat" rows="16" cols="20" id="places" name="places"><?php echo urldecode(str_replace('<br>',"\n",$options['places'])); ?></textarea></label>


<label style="display:block; margin-bottom:10px;" for="unit" >
Unit: <select id="unit" name="unit" >
				<option <?php if("Celsius"==$options['unit']) { echo "selected='selected'"; }?>>Celsius</option>
				<option <?php if("Fahrenheit"==$options['unit']) { echo "selected='selected'"; }?>>Fahrenheit</option>
			</select>
</label>

 <label style="display:block; margin-bottom:10px;" for="cachetime" >Cache time (in seconds): <input type="text" id="cachetime" name="cachetime"
 value="<?php echo $options['cachetime']; ?>" /></label>

        <input type="hidden" name="submit" id="submit" value="1" />

       

<?php

if (substr(decoct( fileperms(str_replace('\\', '/', dirname(__FILE__))."/cache") ), 2) != "777") {
echo "<b><font color='red'>The directory named 'cache' must be set to 777 in ".str_replace('\\', '/', dirname(__FILE__))."</font></b>";
}

    // end of widget_mywidget_control()
   }

    // This registers the widget. About time.
    register_sidebar_widget('Yahoo Weather', 'widget_yahoo_weather');

    // This registers the (optional!) widget control form.
    register_widget_control('Yahoo Weather', 'widget_yahoo_weather_control',430,500);
 
}

// Delays plugin execution until Dynamic Sidebar has loaded first.
add_action('plugins_loaded', 'widget_yahoo_weather_init');
?>
