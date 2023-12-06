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
if ($lieu != NULL)  {
?> 
<div class="container">
    <h2>Liste des lieux</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Libelle</th>
                <th>Adresse</th>
                <th>Service</th>
            </tr>
        </thead>
    <tbody>
    
<?php
    // Boucle de parcours de toutes les lignes du résultat obtenu
    foreach($lieu as $lie){
    // Affichage d’une ligne de tableau pour un pseudo non encore traité
        if (!isset($traite[$lie["lie_id"]])){
            $id_lie=$lie["lie_id"];
            //echo "<tr>";
            //echo "<td>";echo $a["com_pseudo"];echo "</td>";
            //echo "<td>";
            // Boucle d’affichage des lieualités liées au pseudo
            foreach($lieu as $l)  {
                if($id_lie == $l["lie_id"])   {
?>
                    <tr>
                <?php
                    echo "<td>";echo $l["lie_libelle"];echo "</td>";
                    echo "<td>";echo $l["lie_adresse"];echo "</td>";
                    if($l["sev_nom"] == NULL)   {
                        echo "Pas de service dans ce lieu !";
                    }
                    else {
                        echo "<td>";echo $l["sev_nom"];echo "</td>";
                    }
                ?>
                    <tr>
                <?php
                }
            }
            // Conservation du traitement du pseudo
            // (dans un tableau associatif dans cet exemple !)
            $traite[$lie["lie_id"]]=1;
        }
    }
}
else {
    echo "<br />";
    echo "Aucun lieu pour l'instant !";
}
                ?>
    </tbody>
    </table>
</div>

        </div> <!-- div bloc_page -->
    </BODY>
</HTML>