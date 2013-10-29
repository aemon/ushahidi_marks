=== About ===
name: Mark
website: http://www.ushahidi.com
description: For add marks to reports
version: 0.1
requires: 2.1
tested up to: 2.1
author: Oksana Lysak
author website: http://www.ushahidi.com

== Description ==
For add marks to reports

== Installation ==
1. Copy the entire /mark/ directory into your /plugins/ directory.
2. Open /plugins/mark/config/mark.php and set the appropriate settings
3. Activate the plugin.

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
