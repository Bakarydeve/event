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

<div class="container">
    <h2>Les caractéristiques de l'animations</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Animation intitulé</th>
                <th>Animation texte</th>
                <th>Animation debut</th>
                <th>Animation fin</th>
                <th>Animation durée</th>
                <th>Lieu intitulé</th>
                <th>Lieu</th>
            </tr>
        </thead>
    <tbody>
<?php
if($anim != NULL)   {
    foreach($anim as $ani){
?>
        <tr>
<?php
        echo "<td>";echo $ani["ani_intitule"];echo "</td>";
        echo "<td>";echo $ani["ani_texte"];echo "</td>";
        echo "<td>";echo $ani["ani_date_debut"];echo "</td>";
        echo "<td>";echo $ani["ani_date_fin"];echo "</td>";
        echo "<td>";echo $ani["ani_duree"];echo "</td>";
        if($ani["lie_libelle"] == NULL) {
            echo "<td>";echo "Aucun lieu";echo "</td>";
        }
        else {
            echo "<td>";echo $ani["lie_libelle"];echo "</td>";
        }
?>
        <tr>
<?php
    }
}
else {
    echo "erreur";
}
?>
    </tbody>
    </table>
</div>



    }

        </div> <!-- div bloc_page -->
    </BODY>
</HTML>