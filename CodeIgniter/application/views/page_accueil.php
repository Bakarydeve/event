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
                    <li class="active"><a href="<?php echo base_url();?>index.php/accueil/afficher">Home</a></li>
                    <li><a href="<?php echo base_url();?>index.php/invite/afficher">Invités</a></li>
                    <li><a href="<?php echo base_url();?>index.php/programmation/animation">Programmation</a></li>
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
<center><h2>Les caractéristiques de l'événement</h2></center>
<?php
/*
	$Emplacement est notre variable contenant le chemin dont le contenu est à afficher
	Il se présente ici sous cette forme :
	./MesFichiers/MonFichierAEffacer.txt
*/
	
$Emplacement = "./fic_cong.txt";
if (file_exists($Emplacement)) {
	$lines = file($Emplacement);
	$count = count($lines);
	//echo "nbr de lignes : ".$count."<br />\n";
?>
	<div class="container">
<?php
	echo "<textarea class=\"textareaMonDocument\" name=\"TxtContenuFichier\" id=\"TxtContenuFichier\" cols=\"100\" rows=\"".($count+2)."\" disabled>\n"; //Debut du textarea
	foreach ($lines as $line_num => $line) {
		//echo $line; //Affichage brut de la ligne. Pas besoin d'ajouter de /n (linefeed) pour un retour à la ligne, le fichier doit déjà les contenir
		// Affiche de la ligne en la convertissant en code HMTL
		if (mb_detect_encoding($line, 'UTF-8', true) === false) {$line = utf8_encode($line);} //Codage en utf8 pour que l'affichage se passe bien sur cette page qui est en utf8
			//$line = htmlentities($line, ENT_QUOTES, "UTF-8"); //Convertit tous les caractères éligibles en entités HTML. Par exemple < devient &lt; ou encore ² devient &sup2; Pas certain que cela serve.
			echo $line;
	}
?>

<?php
	echo "</textarea>\n"; //Debut du textarea
}

?>
	</div>
	<br />



<?php 
if ($actu != NULL)	{
?> 
<div class="container">
  	<h2>Les actualités concernant l'adaptation en animé du webtoon Mercenary Enrollement</h2>
	<table class="table table-hover">
    	<thead>
      		<tr>
      			<th>Pseudo</th>
        		<th>Intitulé</th>
        		<th>Texte</th>
        		<th>Date ajout</th>
      		</tr>
    	</thead>
    <tbody>
    
<?php
	// Boucle de parcours de toutes les lignes du résultat obtenu
	foreach($actu as $a){
	// Affichage d’une ligne de tableau pour un pseudo non encore traité
		if (!isset($traite[$a["act_id"]])){
			$cpt_id=$a["act_id"];
			//echo "<tr>";
			//echo "<td>";echo $a["com_pseudo"];echo "</td>";
			//echo "<td>";
			// Boucle d’affichage des actualités liées au pseudo
			foreach($actu as $act)	{
				if($cpt_id == $act["act_id"])	{
?>
					<tr>
				<?php
					echo "<td>";echo $act["cpt_pseudo"];echo "</td>";
          			echo "<td>";echo $act["act_intitule"];echo "</td>";
					echo "<td>";echo $act["act_texte"];echo "</td>";
					echo "<td>";echo $act["act_date"];echo "</td>";
				?>
					<tr>
				<?php
				}
			}
			// Conservation du traitement du pseudo
			// (dans un tableau associatif dans cet exemple !)
			$traite[$a["act_id"]]=1;
		}
	}
}
else {
	echo "<br />";
	echo "Aucune actualité pour l'instant !";
}
				?>
	</tbody>
	</table>
</div>

	<center><td><a class="btn" href="<?php echo base_url();?>index.php/poste/authentifier">+</a></td></center>

		</div> <!-- div bloc_page -->
	</BODY>
</HTML>