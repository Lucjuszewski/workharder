<?php 
Class Workharder_m extends CI_Model {
    public function SaveInDB($username,$email,$password,$date) {
        $this->load->database();
		if($this->db->query("INSERT INTO workharder_db(username,email,password,date) VALUES('$username','$email','$password','$date')")) {
			return true;
		} else {
			return false;
		}

	}
	public function LoadFromDB($where,$username) {
        
		$this->load->database(); // przenieś te zasraną walidacje czy nie ma w bazie danych do kontrolera i chuj
        
		$query = $this->db->query("SELECT * FROM workharder_db WHERE $where=$username");
		return $query;
	}
    public function ValidateUsername($username) {
        if(preg_match('@^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9_-]{6,20}$@',$username)) { 
            $this->load->database();
            $username_esc = $this->db->escape($username);
            $query = $this->LoadFromDb('username',$username_esc);
            if($query->num_rows()==0) {
                return true;
            } else {
                return false;
            }
        }else {
                return false;
            }
        
    } 
    public function ValidateEmail($email) {
        if(filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $this->load->database();
            $email_esc = $this->db->escape($email);
            $query = $this->LoadFromDb('username',$email_esc);
            if($query->num_rows()==0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } 
    public function ValidatePassword($password) {
        if(preg_match('@^[A-Za-zóąśłżźćńÓĄŚŁŻŹĆŃ0-9]{6,16}$@',$password)) {
                return true;
        } else {
            return false;
        }
    }
    public function ValidateCheckbox($box) {
        if($box==1) {
            return true;
        } else {
            return false;
        }
    }
}
?>