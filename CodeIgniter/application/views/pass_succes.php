<?php
//echo $this->session->userdata('statut');
//echo $_SESSION['statut'];
if($_SESSION['statut'] != 'I'){
    //echo "mon statut"; echo" "; echo($_SESSION['statut']);
    redirect(base_url()."index.php/compte/connecter_compte");
}

$url = "passeport";
echo "Bravo ! Formulaire rempli, nouveau passeport créer avec succès !";
header("refresh:5;url=$url");
?>
