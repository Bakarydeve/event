<?php  
if($pass)	{
	redirect(base_url()."index.php/compte/passeport");
}
else {
	echo "Une erreur est survenue lors de la suppression du passeport";
}
?>