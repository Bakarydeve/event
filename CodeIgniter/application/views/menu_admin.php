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
                    <li><a href="<?php echo base_url();?>index.php/compte/admin_accueil">Home</a></li>
                    <li><a href="<?php echo base_url();?>index.php/compte/profil_admin">Profil</a></li>
                    <li><a href="<?php echo base_url();?>index.php/compte/admin_animation">Programmation</a></li>
                    <li><a class="btn" href="<?php echo base_url();?>index.php/compte/deconnecter">Déconnexion</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div> 
    <!-- /.navbar -->
		
	</HEAD>