<!DOCTYPE html>
<HTML lang="fr">
	<HEAD>
		<meta charset="utf-8" />
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top headroom" >
        <div class="container">
            <div class="navbar-header">
                <!-- Button for smallest screens -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="index.html"><img src="<?php echo base_url();?>assets/images/logo.png" alt="Progressus HTML5 template"></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                	<li><a href="<?php echo base_url();?>index.php/accueil/afficher">Home</a></li>
                    <li><a href="<?php echo base_url();?>index.php/invite/afficher">Invités</a></li>
                    <li class="active"><a href="<?php echo base_url();?>index.php/programmation/animation">Programmation</a></li>
                    <li><a href="">Objets trouvés</a></li>
                    <li><a href="<?php echo base_url();?>index.php/lieu/afficher">Lieux</a></li>
                    <li><a href="">Posts</a></li>
                    <li><a class="btn" href="<?php echo base_url();?>index.php/compte/connecter_compte">Connexion</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div> 
    <!-- /.navbar -->
		
	</HEAD>

	<BODY>

		<div id="bloc_page">

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
			<td><a class="btn" href="<?php echo base_url();?>index.php/programmation/info_animation/<?php echo $ani["ani_id"];?>">Détail</a></td>
            <td><a class="btn" href="<?php echo base_url();?>index.php/programmation/galerie_invite/<?php echo $ani["ani_id"];?>">Invités</a></td>
            <td><a class="btn" href="<?php echo base_url();?>index.php/programmation/animation_lieu/<?php echo $ani["ani_id"];?>">Lieu/services</a></td>
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
	//}
//}
}
else {
	echo "<br />";
	echo "Aucune animation pour l'instant !";
}
				?>


		</div> <!-- div bloc_page -->
	</BODY>
</HTML>