<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Mark Library
 *
**/
class Mark_Core {
	

	public function __construct()
	{
		
		$this->table_prefix = Kohana::config('database.default.table_prefix');
		
	}

	

	
}
