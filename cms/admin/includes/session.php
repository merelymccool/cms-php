<?php 

class Session {

    private $signedin = false;
    public $user_id;
    public $user_name;
    public $first_name;
    public $last_name;
    public $message;
    public $count;

    function __construct() {
        session_start();
        $this->check_signed_in();
        $this->check_message();
        $this->vistior_count();
    } // End of __construct

    public function get_signed_in() {
        return $this->signedin;
    } // End of get_signed_in

    public function sign_in($found_user) {
        if($found_user) {
            // $user = new User();
            $this->user_id = $_SESSION['user_id'] = $found_user->id;
            $this->user_name = $_SESSION['user_name'] = $found_user->user_name;
            $this->first_name = $_SESSION['first_name'] = $found_user->first_name;
            $this->last_name = $_SESSION['last_name'] = $found_user->last_name;
            $this->signedin = true;
        }
    } // End of sign_in

    public function sign_out() {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        unset($_SESSION['count']);
        unset($this->count);
        $this->signedin = false;
    } // End of sign_out

    private function check_signed_in() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signedin = true;
        } else {
            unset($this->user_id);
            $this->signedin = false;
        }
    } // End of check_signed_in

    public function vistior_count() {
        if(isset($_SESSION['count'])) {
            return $this->count = $_SESSION['count']++;
        } else {
            return $_SESSION['count'] = 1;
        }
    }

    public function message($msg="") {
        if(!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    } // End of message

    private function check_message() {
        if(isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    } // End of check_message
    
} // End of Session class
$session = new Session();
$msg = $session->message();

?>