<?php echo validation_errors(); ?>
<?php echo form_open(''); ?>
 <label for="passid">Passeport identifiant</label>
 <input type="input" name="passid" /><br />
 <label for="passmdp">Passeport mot de passe</label>
 <input type="input" name="passmdp" /><br />
 <input type="submit" name="submit" value="Créer passeport" />
</form>