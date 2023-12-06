<?php
if($_SESSION['inv_statut']!= 'I'){
redirect(base_url()."index.php/compte/connecter_compte");
}
?>

<h2>Espace d'administration</h2>
<br />
<h2>Session ouverte ! Bienvenue
<?php
echo $this->session->userdata('username');
?>
! </h2>

