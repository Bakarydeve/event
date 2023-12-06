            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li><a href="<?php echo base_url();?>index.php/accueil/afficher">Home</a></li>
                    <li><a href="<?php echo base_url();?>index.php/invite/afficher">Invités</a></li>
                    <li class="active"><a href="<?php echo base_url();?>index.php/programmation/animation">Programmation</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Objets trouvés</a></li>
                    <li><a href="">Lieux</a></li>
                    <li><a href="">Posts</a></li>
                    <li><a class="btn" href="">Connexion</a></li>
                    <li><a class="btn" href="">Déconnexion</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div> 
    <!-- /.navbar -->

<?php echo validation_errors(); ?>
<?php echo form_open('compte_creer'); ?>
 <label for="id">Identifiant</label>
 <input type="input" name="id" /><br />
 <label for="mdp">Mot de passe</label>
 <input type="input" name="mdp" /><br />
 <input type="submit" name="submit" value="Créer un compte" />
</form>