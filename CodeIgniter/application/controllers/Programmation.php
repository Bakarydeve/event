<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Programmation extends CI_Controller {

   public $identifiant = null;

   public function __construct()
   {
      parent::__construct();
      $this->load->model('db_model');
      $this->load->helper('url_helper');

      $this->identifiant = $this->session->userdata('identifiant');
   }


   public function animation()
   {

      $data['anim'] = $this->db_model->get_all_animation();

      //Chargement de la view haut.php
      $this->load->view('templates/haut');
      //Chargement de la view du milieu : menu_animation.php
      $this->load->view('menu_animation',$data);
      //Chargement de la view bas.php
      $this->load->view('templates/bas');

   }




   public function info_animation($numero)
   {
      if($numero==FALSE)   {
         $url=base_url(); header("location:$url");
      }
      $data['anim'] = $this->db_model->get_info_animation($numero);

      //Chargement de la view haut.php
      $this->load->view('templates/haut');
      //Chargement de la view du milieu : menu_animation.php
      $this->load->view('info_ani',$data);
      //Chargement de la view bas.php
      $this->load->view('templates/bas');

   }

   public function galerie_invite($numero)
   {
      if($numero==FALSE)   {
         $url=base_url(); header("location:$url");
      }
      $data['invite'] = $this->db_model->get_invite_url($numero);

      $data['url'] = $this->db_model->get_invite_url($numero);

      $data['poste'] = $this->db_model->get_invite_poste($numero);

      //Chargement de la view haut.php
      $this->load->view('templates/haut');
      //Chargement de la view du milieu : menu_animation.php
      $this->load->view('ani_galerie',$data);
      //Chargement de la view bas.php
      $this->load->view('templates/bas');

   }

   public function animation_lieu($numero)
   {
      if($numero==FALSE)   {
         $url=base_url(); header("location:$url");
      }
      $data['lieu'] = $this->db_model->get_info_lieu($numero);

      //Chargement de la view haut.php
      $this->load->view('templates/haut');
      //Chargement de la view du milieu : menu_animation.php
      $this->load->view('ani_lieu',$data);
      //Chargement de la view bas.php
      $this->load->view('templates/bas');

   }


}
?>