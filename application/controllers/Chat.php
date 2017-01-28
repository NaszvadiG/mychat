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
    /*public function add_post(){
        $this->load->model('Blog_model', 'blog');
        
        $data['title'] = 'Tutorial';
        $data['heading'] = 'Добавление записи';
        
        if(isset($_POST['title']) and isset($_POST['post']))
        {
            $new_title = $_POST['title'];
            $new_post = $_POST['post'];
            $this->blog->Add_post($new_title, $new_post);
        }
        
		$this->load->view('templates/header', $data);
		$this->load->view('add_post', $data);
        $this->load->view('templates/footer');
    }*/
    // За ненадобностью
    /*public function all_posts()
    {
        $this->load->model('Blog_model', 'blog');
        $this->load->helper('date');
        
        $data['title'] = 'Tutorial';
        $data['heading'] = 'Просмотр всех записей';
        $data['query'] = $this->blog->Get_all();
        
		$this->load->view('templates/header', $data);
		$this->load->view('all_posts', $data);
        $this->load->view('templates/footer');
    }*/
    /*public function post()
    {
        $this->load->model('Blog_model', 'blog');
        $this->load->helper('date');
        
        $data['title'] = 'Tutorial';
        $data['heading'] = 'Запись';
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $data['id'] = $this->blog->Post($id);
        }
        
        
		$this->load->view('templates/header', $data);
		$this->load->view('post', $data);
        $this->load->view('templates/footer');
    }*/
}
?>