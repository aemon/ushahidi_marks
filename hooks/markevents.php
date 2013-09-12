<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Mark - Load All Events
 **/

class markevents {
    
    protected $table_prefix;
    protected $table_alias;

    public function __construct()
    {
//        mysql_query("SET NAMES utf8");
        Event::add('system.pre_controller', array($this, 'add'));
        
        $this->table_prefix = Kohana::config('database.default.table_prefix');
        $this->table_alias = Kohana::config('mark.table_alias');
        $this->table_alias = Kohana::config('mark.table_alias');
        $this->request = ($_SERVER['REQUEST_METHOD'] == 'POST')? $_POST : $_GET;
        
    }

    public function add()
    {
        Event::add( Kohana::config('mark.event_display_item_marks'), array($this, 'display_mark'));
        Event::add(Kohana::config('mark.event_display_admin_item_marks'), array($this, 'display_admin_marks'));
        Event::add(Kohana::config('mark.event_save_admin_item_marks'),  array($this, 'save_marks')); 
        Event::add(Kohana::config('mark.event_add_mark_to_filter'),  array($this, 'set_list_params')); 
        Event::add(Kohana::config('mark.event_display_all_marks'),  array($this, 'display_all_marks')); 
    }
    
    public function  display_mark(){      

        $element_id = Event::$data;
        $view = View::factory('marks_block');
        $mark =  (!empty($this->request['mark']))?$this->request['mark']:0;
        $view->active_mark = $mark;
        $db = Database::instance();
        $query = 'SELECT m.id, m.name '
                . 'FROM '.$this->table_prefix.'marks as m '
                . 'JOIN '.$this->table_prefix.'marks_to_units as mu ON mu.id_marks = m.id '
                . 'WHERE mu.id_units = '.$element_id;
        $query = $db->query($query);
        $view->marks = $query->result_array(FALSE);
        $view->render(TRUE);    
    }   
    
    public function  display_all_marks(){      

        $view = View::factory('marks_block');
        $db = Database::instance();
        $mark =  (!empty($this->request['mark']))?$this->request['mark']:0;
        $query = 'SELECT m.id, m.name '
                . 'FROM '.$this->table_prefix.'marks as m '
                . 'JOIN '.$this->table_prefix.'marks_to_units as mu ON mu.id_marks = m.id ';
        $query = $db->query($query);
        $view->marks = $query->result_array(FALSE);
        $view->active_mark = $mark;
        $view->render(TRUE);    
    }  
    
public function  display_admin_marks(){      

        $element_id = Event::$data;
        $view = View::factory('admin_marks_block'); 
        $db = Database::instance();
        $query = 'SELECT id, name '
                . 'FROM '.$this->table_prefix.'marks';
        $query = $db->query($query);
        $view->marks = $query->result_array(FALSE);  
        $view->selected_marks = array();
        if (!empty($element_id)){
            $query = 'SELECT id_marks '
                    . 'FROM '.$this->table_prefix.'marks_to_units '
                    . ' WHERE id_units ='.$element_id;
            $query = $db->query($query); 
           
            $marks_result = $query->result_array(FALSE);  
            foreach($marks_result as $m){
                $view->selected_marks[]= $m['id_marks'];
            } 
        }
  
        $view->render(TRUE);    
    }
    
    public function  save_marks(){      
        $db = Database::instance();
            
        $element_id = Event::$data;
        
       // $query = "SET NAMES 'utf8'";
       // $query = $db->query($query); 
       // $query = "SET CHARACTER SET 'utf8'";
      //  $query = $db->query($query); 
      //  $query = "SET SESSION collation_connection = 'utf8_general_ci'";
      //  $query = $db->query($query);
        
        if (!empty($element_id)){
            $marks = (!empty($this->request['marks']))?$this->request['marks']:array();
            $all_marks = (!empty($this->request['hidden_marks']))?$this->request['hidden_marks']:array();
            
            $view = View::factory('admin_marks_block'); 
           
            $query = ' DELETE FROM '.$this->table_prefix.'marks_to_units WHERE id_units='.$element_id;
            $query = $db->query($query);
            foreach ($all_marks as $m){
                $query = ' INSERT INTO '.$this->table_prefix.'marks (name) VALUES ("'.$m.'")';
                //echo $query;
                $m_id = $db->query($query);
                $marks[] = $m_id->insert_id();
            }               
            foreach ($marks as $m){
                if (!empty($m)){
                    $query = ' INSERT INTO '.$this->table_prefix.'marks_to_units (id_marks, id_units) VALUES ('.$m.','.$element_id.')';
                    $query = $db->query($query);  
                }
            }
        }
    }
    
    public function set_list_params(){
        $params = Event::$data;   
        $mark =  (!empty($this->request['mark']))?$this->request['mark']:0;
        if (!empty($mark)){
            $db = Database::instance();
            $query = 'SELECT id_units '
                . 'FROM '.$this->table_prefix.'marks_to_units '
                . ' WHERE id_marks ='.$mark;
            $query = $db->query($query); 
            $ids = array();
            $result = $query->result_array(FALSE);  
            foreach($result as $m){
                $ids[]= $m['id_units'];
            } 
            Event::$data[] = $this->table_alias.'.id IN ('.implode(', ',$ids).')'; 
        }
        return Event::$data;
           
    }
}
new markevents;
