<?php

class User extends Db_object {

    // protected static $db_table = "users";
    protected static $db_table_fields = array('user_name', 'user_pass', 'first_name', 'last_name', 'user_ava');
    public $id;
    public $user_name;
    public $user_pass;
    public $first_name;
    public $last_name;
    public $user_ava;
    public $dir = "avatars";
    public $placeholder = "https://i.imgur.com/2bvab7y.jpg";

    public static function verify_user($username, $password) {
        global $db;
        $username = $db->escape($username);
        $password = $db->escape($password);

        $login_query = "SELECT * FROM users 
                        WHERE user_name = '{$username}' 
                        AND user_pass = '{$password}' 
                        LIMIT 1 ";

        $user_arr = self::find_query($login_query);
        return !empty($user_arr) ? array_shift($user_arr) : false;
    } // End of verify_user

    public function avatar_path() {
        return empty($this->user_ava) ? $this->placeholder : $this->dir.DS.$this->user_ava;
    } // End of avatar_path

    public function set_avatar($file) {
        if (empty($file) || !$file || !is_array($file)) {
            $this->custom_errors[] = "There was no file updoaded here";
            return false;
        } elseif ($file['error'] !=0) {
            $this->custom_errors[] = $this->upload_errors[$file['error']];
            return false;
        } else {
            $this->user_ava = basename($file['name']);
            $this->tmp_name = $file['tmp_name'];
        }
    } // End of set_avatar

    public function save_avatar() {
        if (!empty($this->custom_errors)) {
            return false;
        }
        if (empty($this->user_ava) || empty($this->tmp_name)) {
            $this->custom_errors[] = "The file was not available";
            return false;
        }
        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->dir . DS . $this->user_ava;

        if (file_exists($target_path)) {
            $this->custom_errors[] = "The file {$this->user_ava} already exists";
            return false;
        }
        if (move_uploaded_file($this->tmp_name, $target_path)) {
                unset($this->tmp_name);
                return true;
        } else {
            $this->custom_errors[] = "Check file directory permissions";
            return false;
        }
    } // End of save_avatar

    public function delete_user() {
        if($this->delete()) {
            $target_path = SITE_ROOT . DS . "admin" . DS . $this->avatar_path();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    } // End of delete_user

    public function ajax_save_avatar($image_id, $user_id) {
        global $db;
        $image_id = $db->escape($image_id);
        $user_id = $user_id;

        $this->user_ava = $image_id;
        $this->id = $user_id;

        $sql = "UPDATE " . self::$db_table . " SET user_ava = '" . $this->user_ava . "' WHERE id = " . $this->id;
        $new_ava = $db->query($sql);

        echo $this->avatar_path();
    } // End of ajax_save_avatar

    public static function user_photos($id) {
        return Photo::find_query("SELECT * FROM photos WHERE user_id = " . $id);
    }

} // End of User class
