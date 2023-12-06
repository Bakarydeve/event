<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Compte extends CI_Controller {

    public $username = null;
    public $statut = null;
    public $session_data = array(null);

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');

        $this->username = $this->session->userdata('username');
        $this->statut = $this->session->userdata('statut');
        $this->session_data = array('username' => $this->username,'statut' => $this->statut);
        $this->session->set_userdata($this->session_data);
    }

    public function lister()
    {
        $data['titre'] = 'Liste des pseudos :';
        $data['pseudos'] = $this->db_model->get_all_compte();

        $this->load->view('templates/haut');
        $this->load->view('compte_liste',$data);
        $this->load->view('templates/bas');
    }

    public function deconnecter()
    {
        session_destroy ();
        redirect(base_url()."index.php/compte/connecter_compte");
    }

    public function creer()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('mdp', 'mdp', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/haut');
            $this->load->view('compte_creer');
            $this->load->view('templates/bas');
        }
        else
        {
            $this->db_model->set_compte();
            $this->load->view('templates/haut');
            $this->load->view('compte_succes');
            $this->load->view('templates/bas');
        }
    }

    public function connecter()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pseudo', 'pseudo', 'required');
        $this->form_validation->set_rules('mdp', 'mdp', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/haut');
            $this->load->view('compte_connecter');
            $this->load->view('templates/bas');
        }
        else
        {
            $this->username = $this->input->post('pseudo');
            $password = $this->input->post('mdp');
            if($this->db_model->connect_compte($this->username,$password))
            {
                $session_donnee = array('username' => $this->username );
                $this->session->set_userdata($session_donnee);
                $this->load->view('templates/haut');
                $this->load->view('compte_menu');
                $this->load->view('templates/bas');
            }
            else
            {
                $this->load->view('templates/haut');
                $this->load->view('compte_connecter');
                $this->load->view('templates/bas');
            }
        }
    }

    public function connecter_compte()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pseudo', 'pseudo', 'required');
        $this->form_validation->set_rules('mdp', 'mdp', 'required');
        $this->form_validation->set_message('required', '%s Veuillez remplir tous les champs');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/haut');
            $this->load->view('compte_connecter');
            $this->load->view('templates/bas');
        }
        else
        {
            $username = htmlspecialchars(addslashes($this->input->post('pseudo')));
            $password = htmlspecialchars(addslashes($this->input->post('mdp')));

            
            
            //$statut = $etat->inv_statut;
            //echo $statut;

            if($this->db_model->connect_compte_invite($username,$password))
            {
                $etat = $this->db_model->get_statut_inv($username);
                $session_data = array('username' => $username,'statut' => $etat->inv_statut);
                $this->session->set_userdata($session_data);
                $this->load->view('templates/haut');
                $this->load->view('menu_invite');
                $this->load->view('accueil_invite',$session_data);
                $this->load->view('templates/bas');

                //$this->session->sess_expiration = 100;
                //$this->session->sess_expire_on_close = TRUE;
            }
            else if($this->db_model->connect_compte_organisateur($username,$password))
            {
                $etat_org = $this->db_model->get_statut_org($username);
                $session = array('username' => $username,'statut' => $etat_org->org_statut);
                $this->session->set_userdata($session);
                $this->load->view('templates/haut');
                $this->load->view('menu_admin');
                $this->load->view('accueil_admin',$session);
                $this->load->view('templates/bas');

                //$this->session->sess_expiration = 100;
                //$this->session->sess_expire_on_close = TRUE;
            }
            else
            {
                $url = "connecter_compte";
                echo "Identifiants erronés ou inexistants !";
                header("refresh:5;url=$url");
            }
        }
    }

   public function invite_accueil()
   {

        $user = $this->username;
        $data['invite'] = $this->db_model->get_invite($user);

        $etat_invite = $this->db_model->get_statut_inv($user);
        $session_data = array('username' => $user,'statut' => $etat_invite->inv_statut);
        $this->session->set_userdata($session_data);

        //Chargement de la view haut.php
        $this->load->view('templates/haut');
        //Chargement de la view du milieu : accueil_invite.php
        $this->load->view('menu_invite');
        $this->load->view('accueil_invite');
        //Chargement de la view bas.php
        $this->load->view('templates/bas');

   }

   public function profil_invite()
   {

        $user = $this->username;
        $data['invite'] = $this->db_model->get_invite($user);

        $etat_invite = $this->db_model->get_statut_inv($user);
        $session_data = array('username' => $user,'statut' => $etat_invite->inv_statut);
        $this->session->set_userdata($session_data);

        //Chargement de la view haut.php
        $this->load->view('templates/haut');
        //Chargement de la view du milieu : accueil_invite.php
        $this->load->view('menu_invite');
        $this->load->view('profil_invite',$data);
        //Chargement de la view bas.php
        $this->load->view('templates/bas');

   }

   public function modifier()
   {

        $user = $this->username;
        $data['invite'] = $this->db_model->get_invite($user);

        $etat_invite = $this->db_model->get_statut_inv($user);
        $session_data = array('username' => $user,'statut' => $etat_invite->inv_statut);
        $this->session->set_userdata($session_data);

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nom', 'nom', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('discipline', 'discipline', 'required');
        $this->form_validation->set_rules('biographie', 'biographie', 'required');
        $this->form_validation->set_rules('reseaux', 'reseaux', 'required');
        $this->form_validation->set_rules('mdp', 'mdp', 'required');
        $this->form_validation->set_rules('new_mdp', 'new_mdp', 'required');
        $this->form_validation->set_message('required', '%s Champs de saisie vides !');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/haut');
            $this->load->view('menu_invite');
            $this->load->view('modifier_invite',$data);
            //$this->load->view('mdp_invite',$data);
            $this->load->view('templates/bas');
        }
        else
        {
            $mdp = htmlspecialchars(addslashes($this->input->post('mdp')));
            $nouveau = htmlspecialchars(addslashes($this->input->post('new_mdp')));
            if(strcmp($mdp, $nouveau) != 0) {
                $url = "modifier";
                echo "Confirmation du mot de passe erronée, veuillez réessayer !";
                header("refresh:5;url=$url");
            }
            else {
                $this->db_model->set_mdp_invite($user);
                $this->load->view('templates/haut');
                $this->load->view('menu_invite');
                $this->load->view('modification_succes');
                $this->load->view('templates/bas');
            }
        }

   }


   public function info_invite()
   {

        $user = $this->username;
        $data['invite'] = $this->db_model->get_all_info_invite($user);

        $etat_invite = $this->db_model->get_statut_inv($user);
        $session_data = array('username' => $user,'statut' => $etat_invite->inv_statut);
        $this->session->set_userdata($data);

        //Chargement de la view haut.php
        $this->load->view('templates/haut');
        //Chargement de la view du milieu : accueil_invite.php
        $this->load->view('menu_invite');
        $this->load->view('pass_pos',$data);
        //Chargement de la view bas.php
        $this->load->view('templates/bas');

   }

   public function admin_accueil()
   {

        $user = $this->username;
        $data['admin'] = $this->db_model->get_admin($user);

        $etat_admin = $this->db_model->get_statut_org($user);
        $session_data = array('username' => $user,'statut' => $etat_admin->org_statut);
        $this->session->set_userdata($session_data);

        //Chargement de la view haut.php
        $this->load->view('templates/haut');
        //Chargement de la view du milieu : accueil_invite.php
        $this->load->view('menu_admin');
        $this->load->view('accueil_admin');
        //Chargement de la view bas.php
        $this->load->view('templates/bas');

   }

   public function profil_admin()
   {

        $user = $this->username;
        $data['admin'] = $this->db_model->get_admin($user);

        //Chargement de la view haut.php
        $this->load->view('templates/haut');
        //Chargement de la view du milieu : accueil_invite.php
        $this->load->view('menu_admin');
        $this->load->view('profil_admin',$data);
        //Chargement de la view bas.php
        $this->load->view('templates/bas');

   }

   public function admin_animation()
   {

        //$user = $this->username;
        $data['anim'] = $this->db_model->get_all_animation();

        //Chargement de la view haut.php
        $this->load->view('templates/haut');
        //Chargement de la view du milieu : accueil_invite.php
        $this->load->view('menu_admin');
        $this->load->view('prog_admin',$data);
        //Chargement de la view bas.php
        $this->load->view('templates/bas');

   }

   public function supprimer_animation($numero)
   {

        //$user = $this->username;
        $data['anim'] = $this->db_model->delete_animation($numero);

        //Chargement de la view haut.php
        $this->load->view('templates/haut');
        //Chargement de la view du milieu : accueil_invite.php
        $this->load->view('menu_admin');
        $this->load->view('sup_anim',$data);
        //Chargement de la view bas.php
        $this->load->view('templates/bas');

   }

   public function confirmer_supprimer($numero)
   {

        //$user = $this->username;
        //$data['anim'] = $this->db_model->delete_animation($numero);
        $data['numero'] = $numero;

        //Chargement de la view haut.php
        $this->load->view('templates/haut');
        //Chargement de la view du milieu : accueil_invite.php
        $this->load->view('menu_admin');
        $this->load->view('valider_suppresion',$data);
        //Chargement de la view bas.php
        $this->load->view('templates/bas');

   }

   public function modifier_admin()
   {

        $user = $this->username;
        $data['admin'] = $this->db_model->get_admin($user);

        $etat_org = $this->db_model->get_statut_org($user);
        $session_data = array('username' => $user,'statut' => $etat_org->org_statut);
        $this->session->set_userdata($session_data);

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nom', 'nom', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('numero', 'numero', 'required');
        $this->form_validation->set_rules('mdp', 'mdp', 'required');
        $this->form_validation->set_rules('new_mdp', 'new_mdp', 'required');
        $this->form_validation->set_message('required', '%s Champs de saisie vides !');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/haut');
            $this->load->view('menu_admin');
            $this->load->view('modifier_admin',$data);
            //$this->load->view('mdp_invite',$data);
            $this->load->view('templates/bas');
        }
        else
        {
            $mdp = htmlspecialchars(addslashes($this->input->post('mdp')));
            $nouveau = htmlspecialchars(addslashes($this->input->post('new_mdp')));
            if(strcmp($mdp, $nouveau) != 0) {
                $url = "modifier_admin";
                echo "Confirmation du mot de passe erronée, veuillez réessayer !";
                header("refresh:5;url=$url");
            }
            else {
                $this->db_model->set_mdp_invite($user);
                $this->load->view('templates/haut');
                $this->load->view('menu_admin');
                $this->load->view('admin_succes');
                $this->load->view('templates/bas');
            }
        }

   }

    public function passeport()
    {

        $user = $this->username;
        $data['invite'] = $this->db_model->get_all_info_invite($user);

        $etat_invite = $this->db_model->get_statut_inv($user);
        $invite_id = $this->db_model->get_inv_id($user);
        $session_data = array('username' => $user,'statut' => $etat_invite->inv_statut, 'ide' => $invite_id->inv_id);
        $this->session->set_userdata($data);

        
        //echo $invite_id->inv_id;

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('passid', 'passid', 'required');
        $this->form_validation->set_rules('passmdp', 'passmdp', 'required');
        $this->form_validation->set_message('required', '%s Veuillez remplir tous les champs');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/haut');
            $this->load->view('menu_invite');
            $this->load->view('pass_creer');
            $this->load->view('templates/bas');
        }
        else
        {
            $this->db_model->new_pass($invite_id->inv_id);
            $this->load->view('templates/haut');
            $this->load->view('menu_invite');
            $this->load->view('pass_succes', $session_data);
            $this->load->view('templates/bas');
        }
    }

   public function supprimer_passeport($identifiant)
   {

        //$user = $this->username;
        $data['pass'] = $this->db_model->delete_passeport($identifiant);

        //Chargement de la view haut.php
        $this->load->view('templates/haut');
        //Chargement de la view du milieu : accueil_invite.php
        $this->load->view('menu_invite');
        $this->load->view('sup_pass',$data);
        //Chargement de la view bas.php
        $this->load->view('templates/bas');

   }

   public function desactiver_passeport($identifiant)
   {

        //$user = $this->username;
        $data['pass'] = $this->db_model->off_pass($identifiant);

        //Chargement de la view haut.php
        $this->load->view('templates/haut');
        //Chargement de la view du milieu : accueil_invite.php
        $this->load->view('menu_invite');
        $this->load->view('passoff',$data);
        //Chargement de la view bas.php
        $this->load->view('templates/bas');

   }

}
