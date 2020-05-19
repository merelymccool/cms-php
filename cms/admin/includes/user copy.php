<?php

class User {

    protected static $db_table = "users";
    protected static $db_table_fields = array('user_name', 'user_pass', 'first_name', 'last_name');
    public $user_id;
    public $user_name;
    public $user_pass;
    public $first_name;
    public $last_name;

    public static function find_all() {
       return self::user_query("SELECT * FROM users");
    } // End of find_all_users

    public static function find_user_id($id) {
        $id_arr = self::user_query('SELECT * FROM users WHERE user_id = ' . $id . ' LIMIT 1');
        return !empty($id_arr) ? array_shift($id_arr) : false;
    } // End of find_user_by_id

    public static function user_query($sql) {
        global $db;
        $results = $db->query($sql);
        $obj_arr = array();
        while ($row = mysqli_fetch_array($results)) {
            $obj_arr[] = self::init_user($row);
        }
        return $obj_arr;
    } // End of user_query

    public static function verify_user($username, $password) {
        global $db;
        $username = $db->escape($username);
        $password = $db->escape($password);

        $login_query = "SELECT * FROM users 
                        WHERE user_name = '{$username}' 
                        AND user_pass = '{$password}' 
                        LIMIT 1 ";

        $user_arr = self::user_query($login_query);
        return !empty($user_arr) ? array_shift($user_arr) : false;
    } // End of verify_user

    public static function init_user($record) {
        $user_obj = new self;

        foreach ($record as $property => $value) {

            if ($user_obj->has_property($property)) {
                $user_obj->$property = $value;
            }
        }
        return $user_obj;
    } // End of init_user

    private function has_property($property) {
        $obj_properties = get_object_vars($this);
        return array_key_exists($property, $obj_properties);
    } // End of has_property

    public function properties() {
        // return get_object_vars($this);
        $properties = array();
        foreach (self::$db_table_fields as $db_field) {
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

    }

    public function save_user() {
        return isset($this->id) ? $this->update() : $this->create();
    } // End of save_user

    public function create_user() {
        global $db;
        $properties = $this->escape_properties();
        $values = $this->properties();
        $sql = "INSERT INTO ".self::$db_table 
                ."(". implode(",", array_keys($properties)) .") 
                VALUES
                ('". implode("', '", array_values($properties)) ."');";
        if($db->query($sql)) {
            $this->user_id = $db->insert();
            return true;
        } else {
            return false;
        }
    } // End of create_user

    public function update_user() {
        global $db;
        $properties = $this->escape_properties();
        $property_pairs = array();
        foreach ($properties as $key => $value) {
            $property_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".self::$db_table." SET "
                . implode(",", $property_pairs) .
                " WHERE user_id = '{$db->escape($this->user_id)}';";
        $db->query($sql);
        return (mysqli_affected_rows($db->connection) == 1) ? true : mysqli_error($db->connection);
    } // End of update_user

    public function delete_user() {
        global $db;
        $sql = "DELETE FROM ".self::$db_table."  
                WHERE user_id = '{$db->escape($this->user_id)}' 
                LIMIT 1;";
        $db->query($sql);
        return (mysqli_affected_rows($db->connection) == 1) ? true : mysqli_error($db->connection);
    } // End of delete)user

} // End of User class
