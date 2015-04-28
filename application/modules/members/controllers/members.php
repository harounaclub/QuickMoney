
<?php
    class Members extends MX_Controller{
        
        public function __construct() {
            parent::__construct();
            $this->load->model('login_model');
        }
        

        
        public function index() {
           
               $this->load->view('connexion_view'); 

        }

        function login_user()
        {
         $rules=  $this->login_model->rules;
         $this->form_validation->set_rules($rules);
         
             if ($this->form_validation->run() == TRUE)
             {
                 $email=$this->input->post('login');
                 $password=($this->input->post('password'));
                 $this->login_model->check($email,$password);                 
                 
             }
        }
       function logout()
        {
        //$this->session->unset_userdata('identifant_client');
          
        $this->session->userdata('id_admin');
        $this->session->unset_userdata('nom_pren');
        //session_destroy();
        redirect('login', 'refresh');
         }

        
    }