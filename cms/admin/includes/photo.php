<?php 
class Photo extends Db_object {

    protected static $db_table = "photos";
    protected static $db_column = "photo";
    protected static $db_table_fields = array('photo_title', 'photo_cap', 'photo_desc', 'photo_file', 'photo_alt', 'photo_ext', 'photo_size', 'user_id');
    public $id;
    public $photo_title;
    public $photo_cap;
    public $photo_desc;
    public $photo_file;
    public $photo_alt;
    public $photo_ext;
    public $photo_size;
    public $user_id;
    public $dir = "images";

    public function set_file($file) {

        if (empty($file) || !$file || !is_array($file)) {
            $this->custom_errors[] = "There was no file updoaded here";
            return false;
        } elseif ($file['error'] !=0) {
            $this->custom_errors[] = $this->upload_errors[$file['error']];
            return false;
        } else {
            $this->photo_file = basename($file['name']);
            $this->tmp_name = $file['tmp_name'];
            $this->photo_ext = $file['type'];
            $this->photo_size = $file['size'];
        }
    } // End of set_file

    public function photo_path() {
        return $this->dir . DS . $this->photo_file;
    } // End of photo_path

    public function save() {
        if ($this->id) {
            $this->update();
        } else {
            if (!empty($this->custom_errors)) {
                return false;
            }
            if (empty($this->photo_file) || empty($this->tmp_name)) {
                $this->custom_errors[] = "The file was not available";
                return false;
            }
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->dir . DS . $this->photo_file;

            if (file_exists($target_path)) {
                $this->custom_errors[] = "The file {$this->photo_file} already exists";
                return false;
            }
            if (move_uploaded_file($this->tmp_name, $target_path)) {
                if ($this->create()) {
                    unset($this->tmp_name);
                    return true;
                }
            } else {
                $this->custom_errors[] = "Check file directory permissions";
                return false;
            }
        }
    } // End of save

    public function delete_photo() {
        if($this->delete()) {
            $target_path = SITE_ROOT . DS . "admin" . DS . $this->photo_path();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    } // End of delete_photo

    public static function ajax_photo_info($photo_id) {
        $photo = Photo::find_id($photo_id);

        $output = "<p>{$photo->photo_title}</p>
        <a href='#' class='thumbnail'><img width='100' src='{$photo->photo_path()}' alt=''></a>
        <p>{$photo->photo_file}</p>
        <p>{$photo->photo_ext}</p>
        <p>{$photo->photo_size}</p>";

        echo $output;
    }

}




?>