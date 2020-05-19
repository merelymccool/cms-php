<?php 
class Blog extends Db_object {

    protected static $db_table = "posts";
    protected static $db_table_fields = array('blog_cat', 'blog_title', 'blog_photo', 'blog_author', 'blog_cap', 'blog_body', 'blog_date', 'blog_tags');
    public $id;
    public $blog_cat;
    public $blog_title;
    public $blog_photo;
    public $blog_author;
    public $blog_cap;
    public $blog_body;
    public $blog_date;
    public $blog_tags;
    public $dir = "features";
    public $placeholder = "features/mm-default-blog.png";

    public function default_blog_photo() {
        return empty($this->blog_photo) ? $this->placeholder : $this->dir.DS.$this->blog_photo;
    } // End of avatar_path

    public static function create_blog_comment($blog_id, $author, $body) {
        if(!empty($blog_id) && !empty($author) && !empty($body)) {
            $comment = new Comment();

            $comment->blog_id = (int)$blog_id;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;
        } else {
            return false;
        }
    } // End of create_comment

    public static function find_blog_comment($blog_id) {
        global $db;
        $sql = "SELECT * FROM " . self::$db_table . " WHERE blog_id = " . $db->escape($blog_id);
        return self::find_query($sql);
    } // End of find_comment

    public function set_blog_file($file) {

        if (empty($file) || !$file || !is_array($file)) {
            $this->custom_errors[] = "There was no file updoaded here";
            return false;
        } elseif ($file['error'] !=0) {
            $this->custom_errors[] = $this->upload_errors[$file['error']];
            return false;
        } else {
            $this->blog_photo = basename($file['name']);
            $this->tmp_name = $file['tmp_name'];
        }
    } // End of set_file

    public function save_blog_photo() {
        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->dir . DS . $this->blog_photo;

        if ($this->id) {
            if (move_uploaded_file($this->tmp_name, $target_path)) {
                if ($this->update()) {
                    unset($this->tmp_name);
                    return true;
                }
            } else {
                $this->custom_errors[] = "Check file directory permissions";
                return false;
            }
        } else {
            if (!empty($this->custom_errors)) {
                return false;
            }
            if (empty($this->blog_photo) || empty($this->tmp_name)) {
                $this->custom_errors[] = "The file was not available";
                return false;
            }
            if (file_exists($target_path)) {
                if ($this->create()) {
                    unset($this->tmp_name);
                    return true;
                }
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
    } // End of save_blog_photo

    public static function find_cat_posts($id) {
        return static::find_query("SELECT * FROM " . self::$db_table . " WHERE blog_cat = {$id} ORDER BY id DESC;");
     } // End of find_all_users

     public static function find_user_posts($id) {
        return static::find_query("SELECT * FROM " . self::$db_table . " WHERE blog_author = {$id} ORDER BY id DESC;");
     } // End of find_all_users

}




?>