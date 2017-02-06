<?

class UserModel extends CI_Model{
    
    public function __construct(){
        $this->load->database();
    }
    public function search_user_by_login($login){
        $query = $this->db->get_where('users', array('login' => $login)); //$this->db->get_where('users', array('login' => $login, 'password' => $pass)
        if($query) return $query->row();
        else return false;
    }
    public function search_user($login, $pass){
        $query = $this->db->get_where('users', array('login' => $login, 'password' => $pass)); //$this->db->get_where('users', array('login' => $login, 'password' => $pass)
        if($query) return $query->row();
        else return false;
    }
    public function add_user($login, $pass){
        //Ищем пользователя по введенным данным
        $query = $this->db->get_where('users', array('login' => $login));
        //Если такой существует - ошибка
        if($query->num_rows() > 0) return false; 
        else{ //Иначе добавляем в таблицу и возвращаем успех
            $this->db->insert('users',
            array('login' => $login,
                'password' => $pass)
            );
            return true;
        }
    }
    public function get_user_profile($login){
        $uid = $this->db->get_where('users', array('login' => $login))->row()->id;
        $query = $this->db->get_where('user_profiles', array('user_id' => $uid));
        return $query->result();
    }
    public function update_user_profile($login, $name, $surname, $email, $phone, $about){
        $uid = $this->db->get_where('users', array('login' => $login))->row()->id;
        $this->db->where('user_id', $uid);
        $query = $this->db->update('user_profiles', array('name' => $name, 'surname' => $surname, 'email' => $email, 'phone' => $phone, 'about' => $about));
        if($query) return true; else return false;
    }
    public function insert_user_profile($login){
        $uid = $this->db->get_where('users', array('login' => $login))->row()->id;
        $query = $this->db->insert('user_profiles', array('user_id' => $uid, 'registered' => date('Y-m-d')));
        if($query) return true; else return false;
    }
}

?>