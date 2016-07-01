<?php
 require('../Services/PHPMailer/class.phpmailer.php'); 
 require('../Services/PHPMailer/class.smtp.php'); 

 $data = json_decode(file_get_contents("php://input"));
 //$login = 'pldiop';
 $login = mysql_real_escape_string($data->login);
 //$mdp = 'Palune11';
 $mdp = mysql_real_escape_string($data->mdp);
 //$email = 'palune8@gmail.com';
 $email = mysql_real_escape_string($data->email);
 $cle = md5(microtime(TRUE)*100000);

 mysql_connect('localhost','root','');
 mysql_select_db('cimy');
 mysql_query("BEGIN");
 $res1 = mysql_query('INSERT INTO users(login,mdp,email,cle,actif) VALUES ("'.$login.'","'.$mdp.'","'.$email.'","'.$cle.'",0)'); 
if($res1)
	{
		$query = mysql_query('SELECT MAX(id_user) AS id_user FROM `users`');
		if (mysql_num_rows($query)>0) {
			$id_user = mysql_fetch_assoc($query)['id_user'];
			$taille = ($data->taille);
			$nom = mysql_real_escape_string($data->nom);
			$tel = mysql_real_escape_string($data->tel);
			$pays = mysql_real_escape_string($data->pays);
			$res2 = mysql_query('INSERT INTO entreprise(nom_ets,taille_ets,tel_ets,pays_ets,id_user)
			 VALUES ("'.$nom.'","'.$taille.'","'.$tel.'","'.$pays.'","'.$id_user.'")');
		}
	}
if($res1 && $res2)
	{mysql_query("COMMIT");
	 $mail = new PHPMailer();
	 $mail->IsSMTP();                                      // Set mailer to use SMTP
	 $mail->Host = 'auth.smtp.1and1.fr';  // Specify main and backup SMTP servers
	 $mail->SMTPAuth = true;                               // Enable SMTP authentication
	 $mail->Username = 'smtp@cimyco.com';                 // SMTP username
	 $mail->Password = 'Cimyco$2016';                           // SMTP password
	 //$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	 $mail->Port = 25;

	 
     $mail->SetFrom('smtp@cimyco.com', 'Cimyco Stock');
     $mail->AddAddress($email);
     $mail->Subject = "Activation de votre compte Cimyco Stock";
     $mail->Body    = 'Bienvenue sur l\'activation de votre compte Cimyco Stock,
	 
	 Pour activer votre compte, veuillez cliquer sur le lien ci dessous.
	 
	 http://localhost/Cimystock/Controllers/activation.php?log='.urlencode($login).'&cle='.urlencode($cle).'
	 
	 
	 ---------------
	 Ceci est un mail automatique, Merci de ne pas y répondre.'; 

	 if(!$mail->send()) 
	 	{
	 		
	 	}
	 else 
	 	{
	 		
    	}
	}
else {mysql_query("ROLLBACK");}

?>