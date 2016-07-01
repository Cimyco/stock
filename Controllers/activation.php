<?php
 mysql_connect('localhost','root','');
 mysql_select_db('cimy');
 
 // Récupération des variables nécessaires à l'activation
 $login = $_GET['log'];
 $cle = $_GET['cle'];
 $actif = '';
 $clebdd = '';
 // Récupération de la clé correspondant au $login dans la base de données
 $query = mysql_query("SELECT * FROM users WHERE users.login = '".$login."'");
		if (mysql_num_rows($query)>0)
		{
			
			$clebdd = mysql_fetch_assoc($query)['cle']; // Récupération de la clé
			$actif = mysql_fetch_assoc($query)['actif']; // $actif contiendra alors 0 ou 1
		}
 		
 // On teste la valeur de la variable $actif récupéré dans la BDD
 if($actif == '1') // Si le compte est déjà actif on prévient
  {
     echo "Votre compte est déjà actif !";
  }
 else // Si ce n'est pas le cas on passe aux comparaisons
  {
     if($cle == $clebdd) // On compare nos deux clés	
       {
          // La requête qui va passer notre champ actif de 0 à 1
          mysql_query("UPDATE users SET users.actif = 1 WHERE users.login = '".$login."'");

          // Si elles correspondent on active le compte !	
          echo "Votre compte a bien ete active !";
       }
     else // Si les deux clés sont différentes on provoque une erreur...
       {
          echo "Erreur ! Votre compte ne peut être activé...";
          
        
       }
  }
 
 
//...	
// Fermeture de la connexion	
//...
// Votre code
//...






?>