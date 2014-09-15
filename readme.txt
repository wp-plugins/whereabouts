=== Whereabouts ===
Contributors: florianziegler
Tags: location, timezone, travel, digitalnomad, dashboard, widget
Requires at least: 3.9
Tested up to: 4.0
Stable tag: 0.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Show visitors your current location in the world and the corresponding time (zone).


== Description ==

Show visitors your current location in the world and the corresponding time (zone).

= Dashboard-Widget =
Comfortably set your current location directly on the WordPress dashboard.

= A little help from Google =
Activate the use of the Google Geocoding and Timezone API in the settings: The Plugin will then set the time zone of your whereabouts automatically, when entering a new location.

You can also set the language in which the results of the api requests are returned.

= Requirements =
* PHP 5.2
* WordPress 3.9.2

= Support =
Send a friendly email?

= Website =
* [Whereabouts](http://florianziegler.de/whereabouts)

= Author =
* [Website](http://florianziegler.de)
* [Twitter](https://twitter.com/damndirty)


== Installation ==

1. Upload the `whereabouts` folder to your `/wp-content/plugins` directory.

2. Activate the "Whereabouts" plugin in the WordPress administration interface.

3. Go to "Settings" -> "Whereabouts" and activate "Use Google to get location data" and set the "API Request Language".

4. On the dashboard, set your location.

5. Go to "Appearance" -> "Widgets" and add the Wherebouts widget to a sidebar of your choosing. (You have the options to link your current location to Google Maps and display the time zone name.)

Please note: There is **no extra styling** for the widget. You can however do it yourself, in your theme. This is what the HTML looks like:

`<dl class="whab-info">
    <dt class="whab-label whab-label-location">Current Location:</dt>
    <dd class="whab-location">...</dd>
    <dt class="whab-label whab-label-time">Local Time:</dt>
    <dd class="whab-time">12:34 <span class="whab-timezone-name">...</span></dd>
</dl>`

You must save a location, otherwise the widget won't be displayed.


== Screenshots ==

1. Use the Whereabouts dashboard widget to enter your location
2. Customize the Whereabouts widget


== Changelog ==

= 0.3.0 =
* You can now choose the time format in which the local time is displayed

= 0.2.0 =
* Whereabouts is live

= 0.1.0 =
* Somehow this got skipped...