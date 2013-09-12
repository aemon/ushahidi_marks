<?php defined('SYSPATH') OR die('No direct access allowed.');
    // alias of table in filter-query  in event event_add_mark_to_filter
	$config['table_alias'] = 'i';
    // display marks on item (report) page
    $config['event_display_item_marks']  = 'ushahidi_action.report_display_marks';
    // display all marks on list-items page
    $config['event_display_all_marks']  = 'ushahidi_action.report_display_all_marks';
    // event to display marks for edit
    $config['event_display_admin_item_marks']  = 'ushahidi_action.admin_display_add_marks';
    // event to save item and marks (save report)
    $config['event_save_admin_item_marks']  = 'ushahidi_action.report_edit';
    // event select items by mark (filter reports)
    $config['event_add_mark_to_filter']  = 'ushahidi_filter.fetch_incidents_set_params';
?>