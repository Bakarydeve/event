<?php
if($invite != NULL) {
    foreach($invite as $inv)    {
?> 
<?php echo validation_errors(); ?>
<?php echo form_open('mdp_invite'); 
//<input type="password" name="TB_mot_de_passe" value= '" . $donnees['mot_de_passe'] . "'/>  <input type="submit" name="BT_Envoyer" value="Modifier" />?>
 <label for="nom">Nom</label>
 <input type="text" name="nom" value= "<?php echo $inv['inv_nom'] ?>"/><br />
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

</form>  
<?php    
    }
}
else {
    echo "non";
}
?>


