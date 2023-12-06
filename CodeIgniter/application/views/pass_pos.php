<?php
//echo $this->session->userdata('statut');
//echo $_SESSION['statut'];
if($_SESSION['statut'] != 'I'){
    //echo "mon statut"; echo" "; echo($_SESSION['statut']);
    redirect(base_url()."index.php/compte/connecter_compte");
}
?>

<?php 
if ($invite != NULL)	{
?> 
<div class="container">
  	<center><h2>Les informations personnels de l'invité connecté</h2></center>
	<table class="table table-hover">
    	<thead>
      		<tr>
        		<th>Passeport</th>
        		<th>Poste</th>
      		</tr>
    	</thead>
    <tbody>
    
<?php
// Boucle de parcours de toutes les lignes du résultat obtenu
	foreach($invite as $inv){
?>
		<tr>
		<?php
    	if($inv["pass_id"] == NULL)	{
    		echo "<td>";echo "Aucun passeport";echo "</td>";
    	}
    	else {
    		echo "<td>";echo $inv["pass_id"];echo "</td>";
    	}
    	if($inv["pos_texte"] == NULL)	{
    		echo "<td>";echo "Aucun post";echo "</td>";
    	}
    	else {
    		echo "<td>";echo $inv["pos_texte"];echo "</td>";
    	}

		?>
		<td><a class="btn" href="<?php echo base_url();?>index.php/Compte/supprimer_passeport/<?php echo $inv["pass_id"];?>">Supprimer</a></td>
		<td><a class="btn" href="<?php echo base_url();?>index.php/Compte/desactiver_passeport/<?php echo $inv["pass_id"];?>">Désactiver</a></td>
		</tr>
		<?php
	}
}
/*else {
	echo $_SESSION['statut'];echo "sta";
	echo "Un nouveau poste viens d'être ajouté, veuillez quitté la page puis revenir pour pour le visionné";
}*/
		?>
	</tbody>
	</table>
</div>

<center><td><a class="btn" href="<?php echo base_url();?>index.php/compte/passeport">+</a></td></center>
