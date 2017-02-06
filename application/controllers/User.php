<?
class User extends CI_Controller{
    public function signin(){
        $this->load->model('UserModel');
        $data['title'] = 'Chat / Вход';
        $data['heading'] = 'Вход';
        
        $this->form_validation->set_rules('login', 'Имя пользователя', 'required', array('required' => 'Введите имя пользователя'));
        $this->form_validation->set_rules('pass', 'Пароль', 'required', array('required' => 'Введите пароль'));
        
        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
    		$this->load->view('user/signin', $data);
            $this->load->view('templates/footer');
        }
        else{
            $login = stripslashes(htmlspecialchars(trim($_POST['login'])));
            $pass = stripslashes(htmlspecialchars(trim($_POST['pass'])));
            $user = $this->UserModel->search_user_by_login($login);
            if($user){ //Если пользователь есть, то проверяем пароль
                $user2 = $this->UserModel->search_user($login, $pass);
                if($user2){ //Если имя и пароль совпадают
                    set_cookie('user', $login, 3600); //Куки на час
                    redirect('/');
                }
                else{
                    $data['message'] = 'Неверный пароль';
                }
            }
            else{
                $data['message'] = 'Такой пользователь не существует';
            }
            $this->load->view('templates/header', $data);
    		$this->load->view('user/signin', $data);
            $this->load->view('templates/footer');
        }
        
        /*if(isset($_POST['login']) and isset($_POST['pass']))
        {
            $login = stripslashes(htmlspecialchars(trim($_POST['login'])));
            $pass = stripslashes(htmlspecialchars(trim($_POST['pass'])));
            if($this->UserModel->search_user($login, $pass))
            {
                set_cookie('user', $login, 3600); //Куки на час
                redirect('/');
            }
            else{
                $data['message'] = 'Такой пользователь не существует!';
                $data['mes_type'] = 'error';
                $this->load->view('templates/header', $data);
        		$this->load->view('user/signin', $data);
                $this->load->view('templates/footer');
            }
        }
        else{
            $this->load->view('templates/header', $data);
    		$this->load->view('user/signin', $data);
            $this->load->view('templates/footer');
        }*/
    }
    public function signup(){
        $this->load->model('UserModel');
        $data['title'] = 'Chat / Регистрация';
        $data['heading'] = 'Регистрация';
        
        $this->form_validation->set_rules('login', 'Имя пользователя', 'required|min_length[5]|max_length[20]',
                                    array('required' => 'Введите имя пользователя',
                                            'min_length' => 'Минимальная длина имени пользователя должна быть 5 символов',
                                            'max_length' => 'Максимальная длина имени пользователя должна быть 20 символов'));
        $this->form_validation->set_rules('pass', 'Пароль', 'required|min_length[3]|max_length[20]',
                                    array('required' => 'Введите пароль',
                                            'min_length' => 'Минимальная длина пароля должна быть 3 символа',
                                            'max_length' => 'Максимальная длина пароля должна быть 20 символов'));
        $this->form_validation->set_rules('passconf', 'Пароль', 'required|matches[pass]',
                                    array('required' => 'Введите подтверждение пароля',
                                            'matches' => 'Пароль и подтверждение пароля должны совпадать'));
        
        if($this->form_validation->run() == FALSE){
            //Если форма не прошла валидацию - выводим ее снова
            $this->load->view('templates/header', $data);
    		$this->load->view('user/signup', $data);
            $this->load->view('templates/footer');
        }
        else{
            $login = stripslashes(htmlspecialchars(trim($_POST['login'])));
            $pass = stripslashes(htmlspecialchars(trim($_POST['pass'])));
            if($this->UserModel->add_user($login, $pass)){ //Попытка добавления нового пользователя
                $this->UserModel->insert_user_profile($login); //Добавление профиля нового пользователя
                $data['message'] = 'Пользователь успешно зарегистрирован';
                $data['mes_type'] = 'success';
            }
            else{ //Если не получилось - ошибка
                $data['message'] = 'Пользователь уже существует';
                $data['mes_type'] = 'error';
            }
            $this->load->view('templates/header', $data);
    		$this->load->view('user/signup', $data);
            $this->load->view('templates/footer');
        }
        /*if(isset($_POST['login']) and isset($_POST['pass']))
        {
            $login = stripslashes(htmlspecialchars(trim($_POST['login'])));
            $pass = stripslashes(htmlspecialchars(trim($_POST['pass'])));
            if($this->UserModel->add_user($login, $pass)) //Попытка добавления нового пользователя
            {
                $data['message'] = 'Пользователь успешно добавлен!';
                $data['mes_type'] = 'success';
                $this->load->view('templates/header', $data);
        		$this->load->view('user/signup', $data);
                $this->load->view('templates/footer');
            }
            else{ //Если не получилось - ошибка
                $data['message'] = 'Пользователь уже существует!';
                $data['mes_type'] = 'error';
                $this->load->view('templates/header', $data);
        		$this->load->view('user/signup', $data);
                $this->load->view('templates/footer');
            }
        }
        else{
            $this->load->view('templates/header', $data);
    		$this->load->view('user/signup', $data);
            $this->load->view('templates/footer');
        }*/
    }
    public function signout(){
        delete_cookie('user');
        redirect('/');
    }
    public function profile(){
        if(isset($_COOKIE['user'])){
            $login = $_COOKIE['user'];
            $this->load->model('UserModel');
            $data['title'] = 'Chat / Профиль';
            $data['heading'] = 'Профиль пользователя';
            $data['profile'] = $this->UserModel->get_user_profile($login);
            $this->load->view('templates/header', $data);
    		$this->load->view('user/profile', $data);
            $this->load->view('templates/footer');
        }
        else redirect('/');
    }
    public function edit(){
        if(isset($_COOKIE['user'])){
            $login = $_COOKIE['user'];
            $this->load->model('UserModel');
            $data['title'] = 'Chat / Профиль';
            $data['heading'] = 'Редактирование профиля';
            $data['profile'] = $this->UserModel->get_user_profile($login);
            if(isset($_POST['name']) or isset($_POST['surname']) or isset($_POST['email']) or isset($_POST['phone']) or isset($_POST['about'])){
                $name = stripslashes(htmlspecialchars(trim($_POST['name'])));
                $surname = stripslashes(htmlspecialchars(trim($_POST['surname'])));
                $email = stripslashes(htmlspecialchars(trim($_POST['email'])));
                $phone = stripslashes(htmlspecialchars(trim($_POST['phone'])));
                $about = stripslashes(htmlspecialchars(trim($_POST['about'])));
                if($this->UserModel->update_user_profile($login, $name, $surname, $email, $phone, $about)) $data['message'] = 'Профиль сохранен';
            }
            $this->load->view('templates/header', $data);
    		$this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        }
        else redirect('/');
    }
}



?>