<?php 
class Comment extends Db_object {

    protected static $db_table = "comments";
    protected static $db_column = "com";
    protected static $db_table_fields = array('photo_id', 'blog_id', 'author', 'body');
    public $id;
    public $photo_id;
    public $blog_id;
    public $author;
    public $body;

    public static function create_photo_comment($photo_id, $author, $body) {
        if(!empty($photo_id) && !empty($author) && !empty($body)) {
            $comment = new Comment();

            $comment->blog_id = 0;
            $comment->photo_id = (int)$photo_id;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;
        } else {
            return false;
        }
    } // End of create_photo_comment

    public static function create_blog_comment($blog_id, $author, $body) {
        if(!empty($blog_id) && !empty($author) && !empty($body)) {
            $comment = new Comment();

            $comment->photo_id = 0;
            $comment->blog_id = (int)$blog_id;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;
        } else {
            return false;
        }
    } // End of create_photo_comment

    public static function find_photo_comment($photo_id) {
        global $db;
        $sql = "SELECT * FROM " . self::$db_table . " WHERE photo_id = " . $db->escape($photo_id) . " ORDER BY id DESC;";
        return self::find_query($sql);
    } // End of find_photo_comment

    public static function find_blog_comment($blog_id) {
        global $db;
        $sql = "SELECT * FROM " . self::$db_table . " WHERE blog_id = " . $db->escape($blog_id) . " ORDER BY id DESC; ";
        return self::find_query($sql);
    } // End of find_blog_comment
}




?>