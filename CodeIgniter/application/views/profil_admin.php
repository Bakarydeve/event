<?php
//echo $this->session->userdata('statut');
//echo $_SESSION['statut'];
if($_SESSION['statut'] != 'O'){
    //echo "mon statut"; echo" "; echo($_SESSION['statut']);
    redirect(base_url()."index.php/compte/connecter_compte");
}
?>

<?php 
if ($admin != NULL)	{
?> 
<div class="container">
  	<center><h2>Les informations personnels de l'administrateur connecté</h2></center>
	<table class="table table-hover">
    	<thead>
      		<tr>
      			<th>Pseudo</th>
        		<th>Nom</th>
        		<th>Prenom</th>
        		<th>Email</th>
        		<th>Numéro</th>
      		</tr>
    	</thead>
    <tbody>
    
<?php
// Boucle de parcours de toutes les lignes du résultat obtenu
	foreach($admin as $ad){
?>
		<tr>
		<?php
		echo "<td>";echo $ad["cpt_pseudo"];echo "</td>";
    	echo "<td>";echo $ad["org_nom"];echo "</td>";
    	echo "<td>";echo $ad["org_prenom"];echo "</td>";
    	echo "<td>";echo $ad["org_email"];echo "</td>";
		echo "<td>";echo $ad["org_numero"];echo "</td>";
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

<center><a class="btn btn-primary btn-sn" href="<?php echo base_url();?>index.php/compte/modifier_admin"><i class="fas fa-edit" aria-hidden="true">modifier mot de passe</a></center>