<?php
class Db_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }
    // requête permettant de lister le pseudo de tout les utilisateurs de l'application
    public function get_all_compte()
    {
        $query = $this->db->query("SELECT cpt_pseudo FROM T_COMPTE_CPT;");
        return $query->result_array();
    }
    // requête permettant d'insérer un nouveau utilisateur dans la BDD
    public function set_compte()
    {
        $this->load->helper('url');
        $id=$this->input->post('id');
        $mdp=$this->input->post('mdp');
        $req="INSERT INTO T_COMPTE_CPT VALUES ('".$id."','".$mdp."',now());";
        $query = $this->db->query($req);
        return ($query);
    }

    // requête permettant de mettre à jour le mot de passe d'un invite
    public function set_mdp_invite($user)
    {
        $this->load->helper('url');
        $mdp= htmlspecialchars(addslashes($this->input->post('mdp')));
        $new_mdp= htmlspecialchars(addslashes($this->input->post('new_mdp')));
        $req="UPDATE T_COMPTE_CPT SET cpt_mdp = '".$new_mdp."' WHERE cpt_pseudo = '".$user."';";
        $query = $this->db->query($req);
        return ($query);
    }

    // connection compte utilisateur
    public function connect_compte($username, $password)
    {
        $userspassword = "CeciEstMonMotdePasse!123";
        $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
        $hachage = hash('sha256', $salt.$password);
        //$password = hash('sha256', $salt.$userspassword);
        $query =$this->db->query("SELECT cpt_pseudo,cpt_mdp FROM T_COMPTE_CPT WHERE cpt_pseudo='".$username."' AND cpt_mdp= '".$password."';");
        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // connection compte invité
    public function connect_compte_invite($username, $password)
    {

        $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
        // Le mot de passe rallongé sera donc :
        // OnRajouteDuSelPourAllongerleMDP123!!45678__TestCeciEstMonMotdePasse!123
        $hachage = hash('sha256', $salt.$password);

        //if($requete->num_rows() > 0)    {
        $query =$this->db->query("SELECT cpt_pseudo,cpt_mdp FROM T_COMPTE_CPT JOIN T_INVITE_INV using(cpt_pseudo) WHERE cpt_pseudo='".$username."' AND inv_etat = 'A' AND cpt_mdp='".$password."' or cpt_mdp='".$hachage."';");
        if($query->num_rows() > 0)
        {
            //$userspassword = "CeciEstMonMotdePasse!123";
            $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
            // Le mot de passe rallongé sera donc :
            // OnRajouteDuSelPourAllongerleMDP123!!45678__TestCeciEstMonMotdePasse!123
            $password = hash('sha256', $salt.$password);
            // Constitution par concaténation d'une requête UPDATE + exécution
            $requete = $this->db->query("UPDATE T_COMPTE_CPT SET cpt_mdp='".$password."' WHERE cpt_pseudo='".$username."';");
            return true;
        }
        else
        {
            return false;
        }       
        //}
        //else {
            //echo "La mise à jour du mot de passe à échoué";
        //}

    }
//SELECT cpt_pseudo,cpt_mdp FROM T_COMPTE_CPT JOIN T_ORGANISATION_ORG using(cpt_pseudo) WHERE cpt_pseudo='baki' AND cpt_mdp='babaga97' AND org_statut = 'O'
    // connection compte organisateur
    public function connect_compte_organisateur($username,$password)
    {

        $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
        // Le mot de passe rallongé sera donc :
        // OnRajouteDuSelPourAllongerleMDP123!!45678__TestCeciEstMonMotdePasse!123
        $hachage = hash('sha256', $salt.$password);

        $query =$this->db->query("SELECT cpt_pseudo,cpt_mdp FROM T_COMPTE_CPT JOIN T_ORGANISATION_ORG using(cpt_pseudo) WHERE cpt_pseudo='".$username."' AND org_etat = 'A' AND cpt_mdp='".$password."' or cpt_mdp='".$hachage."';");
        if($query->num_rows() > 0)
        {
            $userspassword = "CeciEstMonMotdePasse!123";
            $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
            // Le mot de passe rallongé sera donc :
            // OnRajouteDuSelPourAllongerleMDP123!!45678__TestCeciEstMonMotdePasse!123
            $password = hash('sha256', $salt.$userspassword);
            // Constitution par concaténation d'une requête UPDATE + exécution
            $requete = $this->db->query("UPDATE T_COMPTE_CPT SET cpt_mdp='".$password."' WHERE cpt_pseudo='".$username."';");
            return true;
        }
        else
        {
            return false;
        }
    }

    // requête permettant de mettre à jour le mdp d'un invité
    public function update_invite_mdp($user)
    {
        $this->load->helper('url');
        $nom=$this->input->post('nom');
        //$email=$this->input->post('email');
        //$discipline=$this->input->post('discipline');
        //$biographie=$this->input->post('biographie');
        //$reseaux=$this->input->post('reseaux');
        //$mdp=$this->input->post('mdp');
        $new_mdp=$this->input->post('new_mdp');
        $nom = ("SELECT inv_nom from T_INVITE_INV WHERE cpt_pseudo = '".$user."';");
        $req=("Update T_COMPTE_CPT Set cpt_mdp = '".$user."';");
        $query = $this->db->query($req);
        return ($query);
    }

    // connection compte invité
    public function get_invite($user)
    {
        $query = $this->db->query("SELECT cpt_pseudo,inv_nom, inv_prenom, inv_email, inv_biographie, inv_discipline, inv_statut, GROUP_CONCAT(url_libelle SEPARATOR '\n') as url_libelle FROM T_INVITE_INV Left Outer Join T_URL_lien using(inv_id) Left Outer Join T_INVITE_URL using(url_id) WHERE cpt_pseudo='".$user."' AND inv_etat = 'A';");
        return $query->result_array();

    }

    // connection compte administrateur
    public function get_admin($user)
    {
        $query = $this->db->query("SELECT * FROM T_ORGANISATION_ORG  WHERE cpt_pseudo='".$user."' AND org_etat = 'A';");
        return $query->result_array();

    }


    // récuperation du statut d'un invité
    public function get_statut_inv($username)
    {
        $query = $this->db->query("SELECT inv_statut FROM T_INVITE_INV WHERE
        cpt_pseudo ='".$username."';");
        return $query->row();
    }

    // récuperation du statut d'un organisateur
    public function get_statut_org($username)
    {
        $query = $this->db->query("SELECT org_statut FROM T_ORGANISATION_ORG WHERE
        cpt_pseudo ='".$username."';");
        return $query->row();
    }

    // récuperation du statut d'un organisateur
    /*public function get_anim_org($user)
    {
        $query = $this->db->query("SELECT org_statut FROM T_ORGANISATION_ORG WHERE
        cpt_pseudo ='".$username."';");
        return $query->row();
    }*/




    // requête permenttant de récuperer le texte d'une actualité dont l'identifiant est passé en paramètre
    public function get_actualite($numero)
    {
        $query = $this->db->query("SELECT act_id,act_texte FROM T_ACTUALITE_ACT WHERE
        act_id =".$numero.";");
        return $query->row();
    }
    // requête permettant de récuperer toutes les actualites de la base
    public function get_all_actualite()
    {
        $query = $this->db->query("SELECT * FROM T_ACTUALITE_ACT join T_ORGANISATION_ORG using(org_id) where act_etat = 'A' Order by act_id desc limit 5;");
        return $query->result_array();
    }
    // requête permettant de récupérer le nombre d'utilisateurs de l'application
    public function get_nb_compte()
    {
        $query = $this->db->query("SELECT count(cpt_pseudo) as nombre FROM T_COMPTE_CPT;");
        return $query->row();
    }
    // requête permettant de récuperer toutes les animations et les infos associés
    public function get_all_animation()
    {
        $query = $this->db->query("SELECT PHASE_ANIMATION(ani_id) as phase_animation, ani_id, ani_intitule, ani_texte, ani_date_debut, ani_date_fin, GROUP_CONCAT(inv_nom SEPARATOR '\n') as nom, GROUP_CONCAT(inv_prenom SEPARATOR '\n') as prenom, GROUP_CONCAT(inv_discipline SEPARATOR ' - ') as discipline, GROUP_CONCAT(inv_biographie SEPARATOR '\n') as biographie, inv_statut, cpt_pseudo, lie_libelle, lie_id from T_ANIMATION_ANI Left Outer join T_JOUE_JOU using(ani_id) Left Outer join T_INVITE_INV using(inv_id) Left Outer Join T_LIEU_LIE using(lie_id) where ani_etat = 'A' group by ani_date_debut, ani_id, phase_animation;");
        return $query->result_array();
    }
    // requête permettant de récuperer touts les invités et les informations les concernant
    public function get_all_invite()
    {
        $query = $this->db->query("SELECT inv_nom, inv_prenom, inv_etat, inv_statut, inv_photo_nom, inv_discipline, GROUP_CONCAT(url_libelle SEPARATOR '\n') as reseau, pos_id, GROUP_CONCAT(pos_texte SEPARATOR '\n') as poste  FROM T_INVITE_INV Left Outer Join T_URL_lien using(inv_id) Left Outer join T_INVITE_URL using(url_id) Left Outer Join T_PASSEPORT_PASS using(inv_id) Left Outer Join T_POST_POS using(pass_id) where inv_etat = 'A' group by inv_id order by pos_id desc;");
        return $query->result_array();
    }

    // requête permettant de récuperer toutes les actualites de la base
    public function get_all_lie()
    {
        $query = $this->db->query("SELECT lie_id, lie_libelle, lie_descriptif, lie_adresse, sev_id, sev_nom FROM T_LIEU_LIE Left Outer join T_SERVICE_SEV using(lie_id);");
        return $query->result_array();
    }

    // requête permettant de récuperer toutes les informations concernant un invité
    public function get_all_info_invite($user)
    {
        $query = $this->db->query("SELECT * FROM T_INVITE_INV Left Outer join T_PASSEPORT_PASS using(inv_id) Left Outer join T_POST_POS using(pass_id) WHERE cpt_pseudo = '".$user."' AND inv_etat = 'A';");
        return $query->result_array();
    }

    // requête permettant de récuperer toutes les informations concernant une invité
    public function get_info_animation($numero)
    {
        $query = $this->db->query("SELECT * FROM T_ANIMATION_ANI Left Outer Join T_LIEU_LIE using(lie_id)  WHERE ani_id = '".$numero."';");
        return $query->result_array();
    }

    // requête permettant de récuperer toutes les informations concernant les invités d'une animation
    /*public function get_info_invites($numero)
    {
        $query = $this->db->query("SELECT ani_id, inv_nom, inv_prenom, inv_etat, inv_statut, inv_photo_nom, inv_discipline, GROUP_CONCAT(url_libelle SEPARATOR '\n') as reseau, pos_id, GROUP_CONCAT(pos_texte SEPARATOR '\n') as poste FROM T_ANIMATION_ANI Left Outer Join T_JOUE_JOU using(ani_id) Left Outer Join T_INVITE_INV using(inv_id) Left Outer Join T_URL_lien using(inv_id) Left Outer join T_INVITE_URL using(url_id) Left Outer Join T_PASSEPORT_PASS using(inv_id) Left Outer Join T_POST_POS using(pass_id)  WHERE ani_id = '".$numero."' group by inv_id;");
        return $query->result_array();
    }*/

    // requête permettant de récuperer toutes les informations concernant les invités d'une animation
    public function get_info_invites($numero)
    {
        $query = $this->db->query("SELECT ani_id, inv_nom, inv_prenom, inv_etat, inv_statut, inv_photo_nom, inv_discipline, url_libelle, pos_id, pos_texte, url_id, inv_id FROM T_ANIMATION_ANI Left Outer Join T_JOUE_JOU using(ani_id) Left Outer Join T_INVITE_INV using(inv_id) Left Outer Join T_URL_lien using(inv_id) Left Outer join T_INVITE_URL using(url_id) Left Outer Join T_PASSEPORT_PASS using(inv_id) Left Outer Join T_POST_POS using(pass_id)  WHERE ani_id = '".$numero."' group by inv_id, pos_id, url_id;");
        return $query->result_array();
    }

    // requête permettant de récuperer toutes les informations concernant le lieu d'une animation
    public function get_info_lieu($numero)
    {
        $query = $this->db->query("SELECT * FROM T_ANIMATION_ANI Left Outer Join T_LIEU_LIE using(lie_id) Left Outer join T_SERVICE_SEV using(lie_id)  WHERE ani_id = '".$numero."';");
        return $query->result_array();
    }

    // requête permettant l'identification d'un membre du staf
    public function authentifie_staf($passid, $passmdp)
    {
        $query =$this->db->query("SELECT pass_id,passMDP FROM T_PASSEPORT_PASS WHERE pass_id='".$passid."' AND passMDP='".$passmdp."';");
        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // requête permettant à un menbre du staff d'un invité d'ajouter un poste pour son inviter
    public function insert_post($passid,$texte)
    {
        $query =$this->db->query("INSERT into T_POST_POS values(null,'".$texte."','A','".$passid."');");
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // requête permettant à un administrateur de supprime une animation
    public function delete_animation($numero)
    {
        $query =$this->db->query("DELETE FROM T_ANIMATION_ANI WHERE ani_id = '".$numero."';");
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // requête permettant de récuperer les invités d'une animation
    public function get_invite_ani($numero)
    {
        $query = $this->db->query("SELECT * FROM T_ANIMATION_ANI Left OUTER JOIN T_JOUE_JOU using(ani_id) Left OUTER JOIN T_INVITE_INV using(inv_id) where ani_id = '".$numero."' group by inv_id;");
        return $query->result_array();
    }

    // requête permettant de récuperer l'url des invités d'une animation
    public function get_invite_url($numero)
    {
        $query = $this->db->query("SELECT * FROM T_JOUE_JOU Left OUTER JOIN T_INVITE_INV using(inv_id) Left OUTER JOIN T_URL_lien using(inv_id) Left OUTER JOIN T_INVITE_URL using(url_id) where ani_id = '".$numero."' group by inv_id, url_id;");
        return $query->result_array();
    }

    // requête permettant de récuperer les poste des membre du staf d'un invité pour une animation
    public function get_invite_poste($numero)
    {
        $query = $this->db->query("SELECT * FROM T_JOUE_JOU Left OUTER JOIN T_PASSEPORT_PASS using(inv_id) Left OUTER JOIN T_POST_POS using(pass_id) where ani_id = '".$numero."' group by inv_id;");
        return $query->result_array();
    }

    // requête permettant de récuperer les invités d'une animation
    public function get_inv_ani()
    {
        $query = $this->db->query("SELECT * FROM T_INVITE_INV;");
        return $query->result_array();
    }

    // requête permettant de récuperer l'url des invités d'une animation
    public function get_inv_url()
    {
        $query = $this->db->query("SELECT * FROM T_JOUE_JOU Left OUTER JOIN T_INVITE_INV using(inv_id) Left OUTER JOIN T_URL_lien using(inv_id) Left OUTER JOIN T_INVITE_URL using(url_id) group by inv_id, url_id;");
        return $query->result_array();
    }

    // requête permettant de récuperer les poste des membre du staf d'un invité pour une animation
    /*public function get_inv_poste()
    {
        $query = $this->db->query("SELECT * FROM T_JOUE_JOU Left OUTER JOIN T_PASSEPORT_PASS using(inv_id) Left OUTER JOIN T_POST_POS using(pass_id) group by inv_id;");
        return $query->result_array();
    }*/

    // requête permettant de récuperer les poste des membre du staf d'un invité pour une animation
    public function get_inv_poste()
    {
        $query = $this->db->query("SELECT * FROM T_POST_POS Left OUTER JOIN T_PASSEPORT_PASS using(pass_id) group by inv_id;");
        return $query->result_array();
    }

    // requête permettant de récuperer le numéro identifiant d'un invité
    public function get_inv_id($user)
    {
        $query = $this->db->query("SELECT inv_id FROM T_INVITE_INV WHERE cpt_pseudo = '".$user."';");
        return $query->row();
    }

    // requête permettant à un invité d'ajouté un nouveau passeport
    public function new_pass($invite_id)
    {
        $this->load->helper('url');
        $passid = $this->input->post('passid');
        $passmdp = $this->input->post('passmdp');
        $query = $this->db->query("INSERT into T_PASSEPORT_PASS values('".$passid."','".$passmdp."', 'A', '".$invite_id."');");
        return($query);
    }

    // requête permettant à un invité de supprime un passeport
    public function delete_passeport($numero)
    {
        $query =$this->db->query("DELETE FROM T_PASSEPORT_PASS WHERE pass_id = '".$numero."';");
        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // requête permettant de mettre à jour le mot de passe d'un invite
    public function off_pass($id)
    {
        $req="UPDATE T_PASSEPORT_PASS SET pass_etat = 'D' WHERE pass_id = '".$id."';";
        $query = $this->db->query($req);
        return ($query);
    }

}






 









