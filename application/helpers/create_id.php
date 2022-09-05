<?php

class CreateId extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public static function init($db, $prefix = "", $table = "", $column = "")
    {
        if($column == "") $column = "id_$table";

        $last_record = $db->query("SELECT $column FROM $table ORDER BY $column DESC LIMIT 1")->row(0, "array");
        $last_id = intval(preg_replace('/[^0-9]/', '', $last_record[$column])) + 1;
        $new_id = $last_id;
        for ($i = 1; $i <= 6; $i++) {
            $new_id = "0$new_id";
            if (strlen($new_id) >= 4) break;
        }
        return $prefix . $new_id;
    }
}
