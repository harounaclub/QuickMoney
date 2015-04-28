<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public $rules = array(
        'login' => array(
      'field' => 'login', 
      'label' => 'login', 
      'rules' => 'trim|required'
    ),
               'password' => array(
      'field' => 'password', 
      'label' => 'password', 
      'rules' => 'trim|required'
    )
     );


    //get informations from people connected

   function check_connection($login,$password){
      $this->db->where('login_user',$login);
      $this->db->where('password_user', $password);
      $q = $this->db->get('user');

      if($q->num_rows()>0)
      {
         return True;        
      }

    }

    function get_infos_people_connected($login,$password){
      $this->db->where('login_user',$login);
      $this->db->where('password_user', $password);
      $q = $this->db->get('user');
    
      if($q->num_rows()>0)
      {
          foreach ($q->result() as $lign)
          {
              $data[]=$lign;
          }
          
          return $data;
      }
    }


//-----------------------------------------------------------------------

    function check($email,$password){
        
       $this->db->where('login_user', $email);
        $this->db->where('password_user', $password);
        $this->db->from('user');
        // Run the query
        $query = $this->db->get();
        // Let's check if there are any results
        if(count($query->result()) == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                    'id_admin' => $row->id_user,
                    'admin_sms' => $row->admin_sms,
                    'super_admin' => $row->super_admin,
                    'nom_pren' => $row->name_user.' '.$row->surname_user
                    );
            $this->session->set_userdata($data);

            redirect('/link/block');
            
        }
        else {
            $list=$this->getdept();
            $this->login_ldap($email,$password,$list);
  }
    }      
   
            
    
    
    
    public function getdept(){
      $q = $this->db->get('department');
      if($q->num_rows()>0)
      {
          foreach ($q->result() as $lign)
          {
              $data[]=$lign;
          }
          
          return $data;
      }
            
    }
    
    public function insert($username,$psswd,$name,$surname){
       $this->db->where('login_user', $username);
        $this->db->where('password_user', $psswd);
        $this->db->from('user'); 
        $query = $this->db->get();
        if(count($query->result()) == 0)
        {
            $this->db->insert('user',array('login_user'=>$username,'password_user'=>$psswd,'name_user'=>$name,'surname_user'=>$surname)); 
            
        }
    }
            
   function login_ldap($username,$psswd,$list){
            
            $ldaprdn  = 'cn=admin,dc=jighi,dc=com';     // DN ou RDN LDAP
            $ldappass = 'J1gh1Ld@p#!';  // Mot de passe associé
            $host = "66.228.35.216";   //Host ou IP serveur Ldap
            
            // Connexion au serveur LDAP
            $ldapconn = ldap_connect($host) or die("Impossible de se connecter au serveur LDAP.");
            
            ldap_set_option ($ldapconn, LDAP_OPT_REFERRALS, 0);
            ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
            error_reporting(0);
            
            if ($ldapconn) {

//                 Connexion au serveur LDAP
                $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

                // Vérification de l'authentification
                if ($ldapbind) {
                    //echo "Connexion LDAP reussie...";
                    foreach($list as $value) { 
                    $dept=$value->department_name;
                    $dn = "uid=".$username.",ou=".$dept.",ou=jighi.com,ou=People,dc=jighi,dc=com";
                    //$value = "1ilianE1";
                    //$value = "romuald123!";
                    $attr = "userPassword";

                   // echo $attr.'<br>'.$value;

                    // Comparaison des valeurs
                    
                    $r=ldap_compare($ldapconn, $dn, $attr, $psswd);

                    if ($r === -1) {
                        
                        $code_error = 1;
                        $msg = "Error: " . ldap_error($ldapconn);
                        
                        $data = array(
                                        'code_error' => $code_error,
                                        'msg' => $msg
                                    );
                      // echo "erreur ldap";
                       // redirect('login');               
                    } elseif ($r === true) {
                        
                        $code_error = 10;
                        $msg = 'Mot de passe est validé';

                       $name='inconnu';
                        $this->insert($username,$psswd,$name,$name);
                        
                        $data = array(
                                        'code_error' => $code_error,
                                        'msg' => $msg
                                    );
                         
                        $this->check($username,$psswd);
                                    break;     
                    } elseif ($r === false) {
                        
                        $code_error = 11;
                        $msg = 'Mot de passe incorrect';
                        
                        $data = array(
                                        'code_error' => $code_error,
                                        'msg' => $msg 
                                    );
                    redirect('login'); 
                    }
            } redirect('login');}else {
                    $error = 0;
                    $msg = "Connexion LDAP échouée...";
                    
                    $data = array(
                                        'code_error' => $code_error,
                                        'msg' => $msg
                                    );
                     redirect('login'); 
                }
//          echo $data['msg'];
            }
            
            
            
        }
    
   }