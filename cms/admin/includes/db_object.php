<?php 

class Db_object {

    protected static $db_table = "users";
    public $tmp_name;
    public $custom_errors = array();
    public $upload_errors = array(
        UPLOAD_ERR_OK         => "There is no error.",
        UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the upload_max_filesize directive.",
        UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the MAX_FILE_SIZE directive.",
        UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE    => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write to disk.",
        UPLOAD_ERR_EXTENSION  => "A PHP entension stopped the file upload.",
    );

    public static function find_all() {
        return static::find_query("SELECT * FROM " . static::$db_table . " ORDER BY id DESC;");
     } // End of find_all_users

     public static function find_query($sql) {
        global $db;
        $results = $db->query($sql);
        $obj_arr = array();
        while ($row = mysqli_fetch_array($results)) {
            $obj_arr[] = static::init($row);
        }
        return $obj_arr;
    } // End of find_query

    public static function find_id($id) {
        $id_arr = static::find_query('SELECT * FROM '. static::$db_table .' WHERE id = ' . $id . ' LIMIT 1');
        return !empty($id_arr) ? array_shift($id_arr) : false;
    } // End of find_id

    public static function init($record) {
        $calling_class = get_called_class();
        $user_obj = new $calling_class;

        foreach ($record as $property => $value) {

            if ($user_obj->has_property($property)) {
                $user_obj->$property = $value;
            }
        }
        return $user_obj;
    } // End of init

    private function has_property($property) {
        $obj_properties = get_object_vars($this);
        return array_key_exists($property, $obj_properties);
    } // End of has_property

    public function properties() {
        // return get_object_vars($this);
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    } // End of properties

    protected function escape_properties() {
        global $db;

        $escape_properties = array();

        foreach ($this->properties() as $key => $value) {
            $escape_properties[$key] = $db->escape($value);
        }
        return $escape_properties;
    } // End of escape_properties

    public function save_all() {
        return isset($this->id) ? $this->update() : $this->create();
    } // End of save_user

    public function create() {
        global $db;
        $properties = $this->escape_properties();
        $values = $this->properties();
        $sql = "INSERT INTO ".static::$db_table 
                ."(". implode(",", array_keys($properties)) .") 
                VALUES
                ('". implode("', '", array_values($properties)) ."');";
        if($db->query($sql)) {
            $this->id = $db->insert();
            return true;
        } else {
            return false;
        }
    } // End of create

    public function update() {
        global $db;
        $properties = $this->escape_properties();
        $property_pairs = array();
        foreach ($properties as $key => $value) {
            $property_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".static::$db_table." SET "
                . implode(",", $property_pairs) .
                " WHERE id = '{$db->escape($this->id)}';";
        $db->query($sql);
        return (mysqli_affected_rows($db->connection) == 1) ? true : mysqli_error($db->connection);
    } // End of update

    public function delete() {
        global $db;
        $sql = "DELETE FROM ".static::$db_table."  
                WHERE id = '{$db->escape($this->id)}' 
                LIMIT 1;";
        $db->query($sql);
        return (mysqli_affected_rows($db->connection) == 1) ? true : mysqli_error($db->connection);
    } // End of delete)user

    public static function count_all() {
        global $db;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        $result = $db->query($sql);
        $row = mysqli_fetch_array($result);

        return array_shift($row);
    } // End of count_all


}



?>