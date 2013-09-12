=== About ===

name: Mark

website: http://www.ushahidi.com

description: Adding labels to reports

version: 0.2

requires: 2.1

tested up to: 2.7

author: Oksana Lysak

author website: http://www.ushahidi.com

== Description ==

Adding labels to reports. 
Users can view labels, associated with report. If they want to see reports with some label they just click on label and view reports.
Added jQuery plugin chosen with some modifications.

== Installation ==

1. Unpack archive with plugin
2. Rename the folder to /mark/
3. Copy the entire /mark/ directory into your /plugins/ directory.
4. Open /plugins/mark/config/mark.php and set the appropriate settings
5. Activate the plugin.

You can add some events in your view files. Such as:
<?php Event::run('ushahidi_action.report_display_marks', $incident_id);?> in /var/www/themes/default/views/reports/detail.php
<?php Event::run('ushahidi_action.admin_display_add_marks', $id); ?> in /var/www/application/views/admin/reports/edit.php
<?php Event::run('ushahidi_action.report_display_all_marks', $incident_id); ?> in /var/www/themes/default/views/reports/list.php

All events you can find in config/mark.php.

== Example ==

/themes/default/views/reports/detail.php
<?php Event::run('ushahidi_action.report_display_marks', $incident_id);?>

CREATE TABLE IF NOT EXISTS `marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8

CREATE TABLE IF NOT EXISTS `marks_to_units` (
  `id_marks` int(11) NOT NULL,
  `id_units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8


== Changelog ==

0.1
* Created the plugin
0.2
* Fixed bug with adding a report from admin page.
