<?php
//echo $this->session->userdata('statut');
//echo $_SESSION['statut'];
if($_SESSION['statut'] != 'O'){
    //echo "mon statut"; echo" "; echo($_SESSION['statut']);
    redirect(base_url()."index.php/compte/connecter_compte");
}
?>


<?php 
if ($anim != NULL)	{
?> 

    
<?php
//foreach($anim as $anii){
	//if (!isset($traite[$anii["ani_id"]])){
	foreach($anim as $a){
		if (!isset($traite[$a["phase_animation"]])){
			$phase = $a["phase_animation"];
?>
			<h1><?php echo($a["phase_animation"]); ?></h1>

<div class="container">
  	<h2>Les caractéristiques des animations prévue</h2>
	<table class="table table-hover">
    	<thead>
      		<tr>
      			<th>ANIMATION INTITULE</th>
      			<th>ANIMATION DEBUT</th>
      			<th>ANIMATION FIN</th>
        		<th>Invités nom</th>
        		<th>Invités prénom</th>
        		<th>Invités discipline</th>
        		<th>Lieu</th>
      		</tr>
    	</thead>
    <tbody>
<?php
			foreach($anim as $ani){
				if(strcmp($phase,$ani["phase_animation"])==0){
?>
					<tr>
<?php
					//echo "<td>";echo $ani["phase_animation"];echo "</td>";
					echo "<td>";echo $ani["ani_intitule"];echo "</td>";
          			//echo "<td>";echo $ani["ani_texte"];echo "</td>";
					echo "<td>";echo $ani["ani_date_debut"];echo "</td>";
					echo "<td>";echo $ani["ani_date_fin"];echo "</td>";
					if($ani["nom"] == NULL && $ani["prenom"] == NULL)	{
						echo "<td>";echo "Aucun invité";echo "</td>";
						echo "<td>";echo "Aucun invité";echo "</td>";
					}
					else	{
          				echo "<td>";echo $ani["nom"];echo "</td>";
						echo "<td>";echo $ani["prenom"];echo "</td>";
					}

					if($ani["discipline"] == NULL)	{
						echo "<td>";echo "Aucun invité";echo "</td>";
					}
					else	{
						echo "<td>";echo $ani["discipline"];echo "</td>";
					}

					if($ani["lie_id"] == NULL)	{
						echo "<td>";echo "Aucun lieu";echo "</td>";
					}
					else	{
						echo "<td>";echo $ani["lie_libelle"];echo "</td>";
					}
					
?>
			
			<td><a class="btn" href="<?php echo base_url();?>index.php/compte/confirmer_supprimer/<?php echo $ani["ani_id"];?>">Supprimer </a></td>
            <td><a class="btn" href="">Modifier </a></td>
<?php

				}
			}
?>

			</tr>
	</tbody>
	</table>
</div>

<?php
			//$traite[$anii["ani_id"]]=1;
			$traite[$a["phase_animation"]]=1;
		}
	}
?>
	<center><td><a class="btn" href="">Ajouter </a></td></center>
<?php
	//}
//}
}
else {
	echo "<br />";
	echo "Aucune animation pour l'instant !";
}
				?>