<?php
//echo $this->session->userdata('statut');
//echo $_SESSION['statut'];
if($_SESSION['statut'] != 'O'){
    //echo "mon statut"; echo" "; echo($_SESSION['statut']);
    redirect(base_url()."index.php/compte/connecter_compte");
}
?>
<center>
<?php
if($admin != NULL) {
    foreach($admin as $adm)    {
?> 
<?php echo validation_errors(); ?>
<?php echo form_open(''); 
//<input type="password" name="TB_mot_de_passe" value= '" . $donnees['mot_de_passe'] . "'/>  <input type="submit" name="BT_Envoyer" value="Modifier" />?>
 <label for="nom">Nom</label>
 <input type="textarea" name="nom" value= "<?php echo $adm['org_nom'] ?>"/></textarea><br />
 <label for="email">Adresse e-mail</label>
 <input type="input" name="email" value= "<?php echo $adm['org_email'] ?>"/><br />
 <label for="numero">Numero</label>
 <input type="input" name="numero" value= "<?php echo $adm['org_numero'] ?>" /><br />
 <label for="mdp">Mot de passe</label>
 <input type="password" name="mdp" /><br />
 <label for="new_mdp">Confirmation du mot de passe</label>
 <input type="password" name="new_mdp" /><br />
 <input type="submit" name="submit" value="Valider" />
 <a class="btn" href="<?php echo base_url();?>index.php/compte/admin_accueil">Annuler</a>

</form>  
<?php    
    }
}
else {
    echo "non";
}
?>
</center>


