<?php
//echo $this->session->userdata('statut');
//echo $_SESSION['statut'];
if($_SESSION['statut'] != 'I'){
    //echo "mon statut"; echo" "; echo($_SESSION['statut']);
    redirect(base_url()."index.php/compte/connecter_compte");
}

?>
<center>
<h2>Espace invité</h2>
<br />
<h2>Session ouverte ! Bienvenue
<?php
echo $this->session->userdata('username');
//echo $this->session->userdata('statut');
 ?>
 ! </h2>
 </center>

