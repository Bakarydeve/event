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
                    <li><a href="<?php echo base_url();?>index.php/programmation/animation">Programmation</a></li>
                    <li><a href="">Objets trouvés</a></li>
                    <li><a href="<?php echo base_url();?>index.php/lieu/afficher">Lieux</a></li>
                    <li><a href="">Posts</a></li>
                    <li class="active"><a class="btn" href="">Connexion</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div> 
    <!-- /.navbar -->
		
	</HEAD>

	<BODY>

		<div id="bloc_page">

<?php echo validation_errors(); ?>
<?php echo form_open('compte/connecter_compte'); ?>
<fieldset>
<center><legend>Saisissez vos identifiants ici :</legend>
<label for="pseudo">pseudo</label>
<input type="text" name="pseudo" /><br>
<label for="mdp">mot de passe</label>
<input type="password" name="mdp" /><br>
<input type="submit" value="Connexion"/>
</fieldset>
</form></center>

		</div> <!-- div bloc_page -->
	</BODY>
</HTML>