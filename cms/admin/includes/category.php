<?php 
class Category extends Db_object {

    protected static $db_table = "categories";
    protected static $db_table_fields = array('cat_title', 'cat_desc');
    public $id;
    public $cat_title;
    public $cat_desc;



}




?>