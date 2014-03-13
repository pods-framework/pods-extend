Pods Starter Plugin
===========

A starter plugin for extending Pods' functionality.

Requires Pods 2.3.18 or later. (Please keep this notice in your plugin and set the appropriate version.)

Instructions
============

1. Naming
You will need to change the name of the plugin in a few simple steps:

Rename the base plugin folder name and primary PHP file named 'pods-extend.php' to your plugin's name. Make sure the folder name matches the name of the PHP file (without .php on the end).

Search for 'pods-extend' and replace with your desired plugin name in all lowercase with dashes between words (if desired).

Search for 'Pods Starter Plugin' and replace with your plugin's proper name.

Search for 'Pods_Extend' and replace with your plugin's proper name with underscores instead of spaces between words.

Be sure to set the plugin header meta data. See [https://codex.wordpress.org/Writing_a_Plugin#Names.2C_Files.2C_and_Locations](https://codex.wordpress.org/Writing_a_Plugin#Names.2C_Files.2C_and_Locations).

2. Usage
<em>Tutorials, like winter are coming.</em>
* Adding options to Pods Admin:

  Check out the example filters in __construct(). Be sure to note the complete example that has example callbacks.

* Adding a new Pods field:
  See the example class. Don't forget to include the file and initialize the class.



Notes and License
==================

This plugin is based on [Base WP Plugin](https://github.com/tareq1988/Base-WP-Plugin) and like Pods and WordPress is licensed under the terms of the GNU General Public License (GPL) version 2.