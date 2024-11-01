=== Yahoo Weather ===
Contributors: magnus0
Tags: widget, widgets, yahoo, weather, sidebar, plugin, sidebar, woeid
Tested up to: 3.3.1
Stable tag: 1.3.4

== Description ==
A simple Yahoo Weather widget

== Installation ==
1. Upload `yahoo-weather` directory to the `/wp-content/plugins/` directory or use Wordpress's built-in plugin search
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Find the 'cache' directory in `/wp-content/plugins/yahoo-weather`, chmod it to 777

== Frequently Asked Questions ==
After you have installed the plugin, open the widgets page from your Wordpress admin. Drag the Yahoo Weather widget to the sidebar.

A working example of this plugin: http://comenius-bs.slipknotee.com

= Usage =
There are 3 attributes: places, unit and cachetime.

* Places. Must be formatted `WOEID|text`
For example
`845743|Tallinn, Estonia
807392|Győr, Hungary
487978|Brzesko, Poland
746203|Porto, Portugal
753692|Barcelona, Spain
23388162|Soverato, Italy`

* To get the WOEID for a city, use this website: http://woeid.rosselliot.co.nz

* Unit is the temperature unit. 'c' for Celsius, 'f' for Fahrenheit. (If no unit is set, it displays the default Celsius)

* Cachetime is optional. If not set, it will be the default 300 seconds. It means that the script will update the weather data every 300 seconds (5 minutes). You problably don't ever have to change it.

You can also style the weather. The weather is in a span with a class `yahooweather`.

== Screenshots ==
1. The widget itself
2. The admin panel

== Changelog ==
= 1.3.4 =
* Fixed a small admin panel bug

= 1.3.3 =
* Important update: now using WOEIDs for locations. You must update your settings
* Updated the admin panel screenshot with WOEID

= 1.3.2 =
* Updated readme.txt (added a working example link)
* Fixed a screenshot

= 1.3.1 =
* Updated description
* Added screenshots

= 1.3.0 =
* MAJOR UPDATE
* Changed the weather code format. See the Usage section in FAQ
* Removed the support for adding weather to a page. Only widget for now
* Updated the widget admin panel look
* Fixed some HTML misalignment bugs

= 1.2.7 =
* Weather in a page was always displayed before all other content. Now displaying where you've written the shortcode.
* Weather in a page shortcode city names escaping, now they can include spaces, slashes or any signs

= 1.2.6 =
* A change in plugin's php file description

= 1.2.5 =
* Fixed a mistake in HTML
* Fixed the 'no image' 3200.png

= 1.2.4 =
* Little HTML typo fix

= 1.2.3 =
* Fixed a layout bug, now using tables

= 1.2.2 =
* Fixed a layout bug

= 1.2.1 =
* A few fixes

= 1.2.0 =
* Changed plugin's name to 'Yahoo Weather'
* Complete rewrite of plugin (now 2x faster)
* Now can display weather in a page/post


