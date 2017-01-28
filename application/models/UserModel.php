<?

class UserModel extends CI_Model{
    
    public function __construct()
    {
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
}

?>