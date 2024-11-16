



<?php

// Inclure le fichier de connexion
include '../components/connect.php';

// Démarrer la session
session_start();

// Récupérer l'identifiant de l'enseignant à partir de la session
$Enseignants_id = $_SESSION['Enseignants_id'];

// Rediriger vers la page de connexion si l'identifiant de l'enseignant n'est pas défini dans la session
if(!isset($_SESSION['Enseignants_id'])){
  header('location:login_Enseignant.php');
}

// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])){

   // Récupérer et filtrer le nom
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   // Récupérer et filtrer l'e-mail
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   
   // Mettre à jour le nom si non vide
   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `Enseignants` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $Enseignants_id]);
   }

   // Vérifier et mettre à jour l'e-mail
   if(!empty($email)){
      $select_email = $conn->prepare("SELECT * FROM `Enseignants` WHERE email = ?");
      $select_email->execute([$email]);
      if($select_email->rowCount() > 0){
         $message[] = 'email déjà utilisé !';
      }else{
         $update_email = $conn->prepare("UPDATE `Enseignants` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $Enseignants_id]);
      }
   }

   // Définir un mot de passe vide pour la comparaison
   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';

   // Récupérer le mot de passe actuel de la base de données
   $select_prev_pass = $conn->prepare("SELECT password FROM `Enseignants` WHERE id = ?");
   $select_prev_pass->execute([$Enseignants_id]);
   $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
   $prev_pass = $fetch_prev_pass['password'];

   // Récupérer et filtrer l'ancien mot de passe saisi par l'utilisateur
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

   // Récupérer et filtrer le nouveau mot de passe saisi par l'utilisateur
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

   // Récupérer et filtrer la confirmation du nouveau mot de passe saisi par l'utilisateur
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   // Vérifier l'ancien mot de passe et mettre à jour le nouveau mot de passe s'ils correspondent
   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $warning_msg[] = 'L\'ancien mot de passe ne correspond pas';
      }elseif($new_pass != $confirm_pass){
         $warning_msg[] = 'La confirmation du nouveau mot de passe ne correspond pas !';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `Enseignants` SET password = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $Enseignants_id]);
            $success_msg[] = 'Opération réussie';
         }else{
            $warning_msg[] = 'Veuillez saisir un nouveau mot de passe';
         }
      }
   }  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Modifier votre compte</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f0f0f0;
         margin: 0;
         padding: 0;
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
      }

      .form-container {
         background-color: #fff;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
         width: 350px;
      }

      .form-container h3 {
         text-align: center;
         margin-bottom: 20px;
         color: #333;
      }

      .box {
         width: 100%;
         padding: 10px;
         margin-bottom: 15px;
         border: 1px solid #ccc;
         border-radius: 5px;
         box-sizing: border-box;
         font-size: 16px;
      }

      .box:focus {
         outline: none;
         border-color: #4CAF50;
      }

      .btn {
         width: 100%;
         background-color: #0075ff;
         color: #fff;
         border: none;
         padding: 10px;
         border-radius: 5px;
         cursor: pointer;
         font-size: 16px;
         transition: background-color 0.3s ease;
      }

      .btn:hover {
         background-color: #45a049;
      }

      .error {
         color: red;
         font-size: 14px;
      }

      .success {
         color: green;
         font-size: 14px;
      }
      
        i.fa-solid.fa-arrow-right {
        position: fixed;
        top: 1%;
        left: 92%;
        color: #00adff;
        margin-right: 3px;  
        direction: rtl;
        font-size: 25px;
        }
   </style>
</head>
<body>

<a href="profile.php" class="o"><i class="fa-solid fa-arrow-right"></i></a>

<section class="form-container">
   <form action="" method="post">
      <h3>Modifier votre compte</h3>
      <?php 
         // Sélectionner les informations de l'enseignant à modifier
         $upd_em = $conn->prepare("SELECT * FROM `Enseignants` WHERE id = ?");
         $upd_em->execute([$Enseignants_id]);
         if($upd_em->rowCount() > 0){
            $fetch_update = $upd_em->fetch(PDO::FETCH_ASSOC);
      ?>
         <input type="text" name="name" placeholder="<?= $fetch_update['name']; ?>" class="box">
         <input type="email" name="email" placeholder="<?= $fetch_update['email']; ?>" class="box">
      <?php } ?>
      <input type="password" name="old_pass" placeholder="Entrez l'ancien mot de passe" class="box">
      <input type="password" name="new_pass" placeholder="Entrez le nouveau mot de passe" class="box">
      <input type="password" name="confirm_pass" placeholder="Confirmez le mot de passe" class="box">
      <input type="submit" value="Mettre à jour maintenant" name="submit" class="btn">
   </form>
</section>

</body>
</html>



