<?php
class Chat extends CI_Controller{
    public function index(){
        $this->load->model('ChatModel');
        $data['title'] = 'Chat / Главная';
        $data['heading'] = 'Главная';
        
        $this->form_validation->set_rules('message', 'Текст сообщения', 'required', array('required' => 'Введите текст сообщения'));
        if($this->form_validation->run() == FALSE) //Если форма не прошла валидацию, то выводим чат и ошибку
        {
            $data['query'] = $this->ChatModel->Get_all_messages_from_chat();
            $this->load->view('templates/header', $data);
    		$this->load->view('index', $data);
            $this->load->view('templates/footer');
        }
        else{
            if(isset($_COOKIE['user']))
            {
                $user = stripslashes(htmlspecialchars(trim($_COOKIE['user'])));
                $message = stripslashes(htmlspecialchars(trim($_POST['message'])));
                $this->ChatModel->Add_message_in_chat($user, $message);
            }
            $data['query'] = $this->ChatModel->Get_all_messages_from_chat();
            $this->load->view('templates/header', $data);
    		$this->load->view('index', $data);
            $this->load->view('templates/footer');
        }
    }
}
?>