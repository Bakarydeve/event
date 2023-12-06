<?php
//echo $this->session->userdata('statut');
//echo $_SESSION['statut'];
if($_SESSION['statut'] != 'I'){
    //echo "mon statut"; echo" "; echo($_SESSION['statut']);
    redirect(base_url()."index.php/compte/connecter_compte");
}
?>
<center>
<?php
if($invite != NULL) {
    foreach($invite as $inv)    {
?> 
<?php echo validation_errors(); ?>
<?php echo form_open(''); 
//<input type="password" name="TB_mot_de_passe" value= '" . $donnees['mot_de_passe'] . "'/>  <input type="submit" name="BT_Envoyer" value="Modifier" />?>
 <label for="nom">Nom</label>
 <input type="textarea" name="nom" value= "<?php echo $inv['inv_nom'] ?>"/></textarea><br />
 <label for="email">Adresse e-mail</label>
 <input type="input" name="email" value= "<?php echo $inv['inv_email'] ?>"/><br />
 <label for="discipline">Discipline</label>
 <input type="input" name="discipline" value= "<?php echo $inv['inv_discipline'] ?>" /><br />
 <label for="biographie">Biographie</label>
 <input type="input" name="biographie" value= "<?php echo $inv['inv_biographie'] ?>"/><br />
 <label for="reseaux">Réseaux sociaux</label>
 <input type="input" name="reseaux" value= "<?php if($inv['url_libelle'] == NULL){ echo "Aucun reseau pour cet invite";} else { echo $inv['url_libelle']; } ?>"/><br />
 <label for="mdp">Mot de passe</label>
 <input type="password" name="mdp" /><br />
 <label for="new_mdp">Confirmation du mot de passe</label>
 <input type="password" name="new_mdp" /><br />
 <input type="submit" name="submit" value="Valider" />
 <a class="btn" href="<?php echo base_url();?>index.php/compte/invite_accueil">Annuler</a>

</form>  
<?php    
    }
}
else {
    echo "non";
}
?> 
</center>



