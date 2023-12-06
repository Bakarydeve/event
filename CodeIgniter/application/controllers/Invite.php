<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Invite extends CI_Controller {

   public function __construct()
   {
      parent::__construct();
      $this->load->model('db_model');
      $this->load->helper('url_helper');
   }


   public function afficher()
   {

      $data['invite'] = $this->db_model->get_inv_ani();

      $data['url'] = $this->db_model->get_inv_url();

      $data['poste'] = $this->db_model->get_inv_poste();

      //Chargement de la view haut.php
      $this->load->view('templates/haut');
      //Chargement de la view du milieu : visiteur_invite.php
      $this->load->view('visiteur_invite',$data);
      //Chargement de la view bas.php
       $this->load->view('templates/bas');

   }
}
?>