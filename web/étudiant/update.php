<?php

include '../components/connect.php';

session_start();

$étudiant_id = $_SESSION['étudiant_id'];

// Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
if(!isset($_SESSION['étudiant_id'])){
  header('location:login_étudiant.php');
}

// Traiter le formulaire de mise à jour des informations de l'étudiant
if(isset($_POST['submit'])){

   $nom = $_POST['name']; // Récupérer le nom de l'étudiant
   $nom = filter_var($nom, FILTER_SANITIZE_STRING); // Nettoyer le nom
   
   $email = $_POST['email']; // Récupérer l'email de l'étudiant
   $email = filter_var($email, FILTER_SANITIZE_STRING); // Nettoyer l'email
   
   if(!empty($nom)){
      $update_nom = $conn->prepare("UPDATE `étudiant` SET name = ? WHERE id = ?");
      $update_nom->execute([$nom, $étudiant_id]);
   }

   if(!empty($email)){
      $select_email = $conn->prepare("SELECT * FROM `étudiant` WHERE email = ?");
      $select_email->execute([$email]);
      if($select_email->rowCount() > 0){
         $message[] = 'email déjà utilisé!';
      }else{
         $update_email = $conn->prepare("UPDATE `étudiant` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $étudiant_id]);
      }
   }

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $select_prev_pass = $conn->prepare("SELECT password FROM `étudiant` WHERE id = ?");
   $select_prev_pass->execute([$étudiant_id]);
   $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
   $prev_pass = $fetch_prev_pass['password'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
        $warning_msg[] = 'Ancien mot de passe incorrect';
    }elseif($new_pass != $confirm_pass){
         $warning_msg[] = 'Confirmation du nouveau mot de passe incorrecte!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `étudiant` SET password = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $étudiant_id]);
            $success_msg[] = 'Opération réussie';
         }else{
            $warning_msg[] = 'Veuillez entrer un nouveau mot de passe';
         }
      }
   }  

}

?>

<!DOCTYPE html>
<html lang="fr">
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
         $upd_em = $conn->prepare("SELECT * FROM `étudiant` WHERE id = ?");
         $upd_em->execute([$étudiant_id]);
         if($upd_em->rowCount() > 0){
            $fetch_update = $upd_em->fetch(PDO::FETCH_ASSOC);
      ?>
         <input type="text" name="name" placeholder="<?= $fetch_update['name']; ?>" class="box">
         <input type="email" name="email" placeholder="<?= $fetch_update['email']; ?>" class="box">
      <?php } ?>
      <input type="password" name="old_pass" placeholder="Entrez votre ancien mot de passe" class="box">
      <input type="password" name="new_pass" placeholder="Entrez votre nouveau mot de passe" class="box">
      <input type="password" name="confirm_pass" placeholder="Confirmez votre nouveau mot de passe" class="box">
      <input type="submit" value="Mettre à jour maintenant" name="submit" class="btn">
   </form>
</section>

</body>
</html>
