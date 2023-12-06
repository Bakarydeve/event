<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Poste extends CI_Controller {

   public function __construct()
   {
      parent::__construct();
      $this->load->model('db_model');
      $this->load->helper('url_helper');
   }


   public function authentifier()
   {

      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->form_validation->set_rules('passid', 'passid', 'required');
      $this->form_validation->set_rules('passmdp', 'passmdp', 'required');
      $this->form_validation->set_rules('poste_texte', 'poste_texte', 'required');

      if ($this->form_validation->run() == FALSE)
      {
         $this->load->view('templates/haut');
         $this->load->view('poste_authentifier');
         $this->load->view('templates/bas');
      }
      else
      {
         $username = htmlspecialchars(addslashes($this->input->post('passid')));
         $password = htmlspecialchars(addslashes($this->input->post('passmdp')));
         $texte = htmlspecialchars(addslashes($this->input->post('poste_texte')));
         if(strlen($texte) > 140)   {
            echo " Un post a 140 caractères maximum";
            redirect(base_url()."index.php/poste/authentifier");
         }

         if($this->db_model->authentifie_staf($username,$password))
         {
            $session_data = array('username' => $username );
            $this->session->set_userdata($session_data);
            if($this->db_model->insert_post($username,$texte))  {
               //$this->load->view('templates/haut');
               $this->load->view('staf_menu');
               //$this->load->view('templates/bas'); 
            }
         }
         else
         {

            $url = "authentifier";
            echo "Code(s) erroné(s), aucun passeport trouvé !";
            header("refresh:5;url=$url");
         }
      }

   }


}
?>