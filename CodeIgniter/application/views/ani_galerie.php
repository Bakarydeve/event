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
            <div class="col-9 row">

<?php
if($invite != NULL) {
    foreach($invite as $inv)    {
        if (!isset($traite[$inv["inv_id"]])){
            $id_inv = $inv["inv_id"];
?>
            <div class="col-lg-3 col-md-6">
                <a href="<?php echo base_url();?>index.php/invite/afficher"><img src="<?php echo base_url('images/')?><?php echo $inv["inv_photo_nom"] ?>" height="200" width="100%" alt=""></a><br>
                    <div class="invite-info">
                        <h6><?php echo $inv["inv_nom"]; echo " "; echo $inv["inv_prenom"]; ?></h6>
                    </div>
                    <br>
                    <?php
                    foreach($url as $lien)    { 
                        //$id_inv = $lien["inv_id"];
                        if($id_inv==$lien["inv_id"]){
                            if($lien["url_libelle"] == NULL)    { 
                                echo "Pas de réseau social pour cet invité !";
                            }
                            else {
                    ?>
                            <p><?php echo '<a href="'.$lien["url_libelle"].'" >   '.$lien["url_libelle"].'  </a>';echo "<br />";?></p>
                    <?php
                            }
                        }
                        //echo $lien["url_libelle"];echo "<br />";
                    }
                    ?>

                    <?php
                    foreach($poste as $pos)    { 
                        //$id_inv = $lien["inv_id"];
                        if($id_inv==$pos["inv_id"]){
                            if($pos["pos_texte"] == NULL)    { 
                                echo "Pas de poste pour cet invité !";
                                echo "<br />";
                            }
                            else {
                    ?>
                            <p><?php echo $pos["pos_texte"];echo "<br />";?></p>
                    <?php
                            }
                        }
                        //echo $lien["url_libelle"];echo "<br />";
                    }
                    ?>

        
            </div>
<?php
        $traite[$inv["inv_id"]]=1;
        }
    }
?>
            </div>
        </div>

<?php
}
else  {
    echo "Aucun invité pour l'instant !";
}
?>

        </div> <!-- div bloc_page -->
    </BODY>
</HTML>