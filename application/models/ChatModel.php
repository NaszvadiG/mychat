<?
class ChatModel extends CI_Model{
    
    public function __construct(){
        $this->load->database();
    }
    public function Get_all_messages_from_chat(){
        $this->db->order_by('date DESC, time DESC');
        $query = $this->db->get('messages');
        return $query->result();
    }
    public function Add_message_in_chat($user, $message){
        $this->db->insert('messages',
        array('user' => $user,
            'message' => $message,
            'date' => date('Y-m-d'),
            'time' => date('H:i:s')));
    }
}
?>