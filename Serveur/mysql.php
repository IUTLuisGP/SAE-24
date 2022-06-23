<?php
  /* Connection script to the smi database */

  $id_bd = mysqli_connect( "localhost","max","Maxime23@", "sae24")
    or die("Connexion au serveur et/ou à la base de données impossible");

  /* Character encoding management */
  mysqli_query($id_bd, "SET NAMES 'utf8'");

?>