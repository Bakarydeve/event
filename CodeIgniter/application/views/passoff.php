<?php  
if($pass)	{
	redirect(base_url()."index.php/compte/passeport");
}
else {
	echo "Bravo, passeport désactiver avec succès !";
}
?>