<?php  
if($anim)	{
	redirect(base_url()."index.php/compte/admin_animation");
}
else {
	echo "Une erreur est survenue lors de la suppression de l'animation";
}
?>