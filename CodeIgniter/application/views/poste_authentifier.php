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

<?php echo validation_errors(); ?>
<?php echo form_open('poste/authentifier'); ?>
<center><label>Saisissez vos identifiants ici :</label><br>
<label for="passid">Pass identifiant</label>
<input type="text" name="passid" /><br>
<label for="passid">Pass mot de passe</label>
<input type="text" name="passmdp" /><br>
<label for="poste_texte">texte du poste à ajouté</label>
<textarea  name="poste_texte" /></textarea><br>
<input type="submit" value="Valider"/>
<a href="<?php echo base_url();?>index.php/accueil/afficher">Annuler</a></li>
</form></center>

		</div> <!-- div bloc_page -->
	</BODY>
</HTML>
