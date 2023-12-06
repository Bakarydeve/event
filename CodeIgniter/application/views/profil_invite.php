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
      			<th>Pseudo</th>
        		<th>Nom</th>
        		<th>Prenom</th>
        		<th>Email</th>
        		<th>Discipline</th>
        		<th>Biographie</th>
        		<th>Réseaux sociaux</th>
      		</tr>
    	</thead>
    <tbody>
    
<?php
// Boucle de parcours de toutes les lignes du résultat obtenu
	foreach($invite as $inv){
?>
		<tr>
		<?php
		echo "<td>";echo $inv["cpt_pseudo"];echo "</td>";
    	echo "<td>";echo $inv["inv_nom"];echo "</td>";
    	echo "<td>";echo $inv["inv_prenom"];echo "</td>";
    	echo "<td>";echo $inv["inv_email"];echo "</td>";
		echo "<td>";echo $inv["inv_discipline"];echo "</td>";
		echo "<td>";echo $inv["inv_biographie"];echo "</td>";
		if($inv["url_libelle"] == NULL)	{
			echo "<td>";echo "Acucun réseaux sociaux pour cet invité";echo "</td>";
		}
		else{
			echo "<td>";echo $inv["url_libelle"];echo "</td>";
		}
		

		?>
		</tr>
		<?php
	}
}
else {
	echo "<br />";
	echo "Identifiants erronés ou inexistants !";
}
		?>
	</tbody>
	</table>
</div>

<center><a class="btn btn-primary btn-sn" href="<?php echo base_url();?>index.php/compte/modifier"><i class="fas fa-edit" aria-hidden="true">modifier mot de passe</a></center>