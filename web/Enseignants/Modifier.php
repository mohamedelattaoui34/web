


<?php

include '../components/connect.php';

session_start();

$Enseignants_id = $_SESSION['Enseignants_id'];

if(!isset($_SESSION['Enseignants_id'])){
  header('location:login_Enseignant.php');
}

if(isset($_POST['save'])){

   $formation = $_GET['id'];
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);

   $public = $_POST['public'];
   $public = filter_var($public, FILTER_SANITIZE_STRING);
   $Exigences = $_POST['Exigences'];
   $Exigences = filter_var($Exigences, FILTER_SANITIZE_STRING);

   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   $update_formation = $conn->prepare("UPDATE `formation` SET title = ?, public = ?, Exigences = ?, status = ? WHERE id = ?");
   $update_formation->execute([$title, $public, $Exigences, $status, $formation]);

   $message[] = 'post updated!';
   
   if(!empty($_FILES['video']['name'])) {
        $video = $_FILES['video']['name'];
        $video_tmp_name = $_FILES['video']['tmp_name'];
        $video_folder = '../uploaded_videos/'.$video;

        move_uploaded_file($video_tmp_name, $video_folder);

        $update_video = $conn->prepare("UPDATE `formation` SET video = ? WHERE id = ?");
        $update_video->execute([$video, $formation]);
   }

}

if(isset($_POST['delete_post'])){

   $formation = $_POST['formation'];
   $formation = filter_var($formation, FILTER_SANITIZE_STRING);
   $delete_video = $conn->prepare("SELECT * FROM `formation` WHERE id = ?");
   $delete_video->execute([$formation]);
   $fetch_delete_video = $delete_video->fetch(PDO::FETCH_ASSOC);
   if($fetch_delete_video['video'] != ''){
      unlink('../uploaded_videos/'.$fetch_delete_video['video']);
   }
   $delete_post = $conn->prepare("DELETE FROM `formation` WHERE id = ?");
   $delete_post->execute([$formation]);
   $delete_demanders = $conn->prepare("DELETE FROM `demanders` WHERE formation_id = ?");
   $delete_demanders->execute([$formation]);
   $message[] = 'post deleted successfully!';

}

if(isset($_POST['delete_video'])){

   $empty_video = '';
   $formation = $_POST['formation'];
   $formation = filter_var($formation, FILTER_SANITIZE_STRING);
   $delete_video = $conn->prepare("SELECT * FROM `formation` WHERE id = ?");
   $delete_video->execute([$formation]);
   $fetch_delete_video = $delete_video->fetch(PDO::FETCH_ASSOC);
   if($fetch_delete_video['video'] != ''){
      unlink('../uploaded_videos/'.$fetch_delete_video['video']);
   }
   $unset_video = $conn->prepare("UPDATE `formation` SET video = ? WHERE id = ?");
   $unset_video->execute([$empty_video, $formation]);
   $message[] = 'video deleted successfully!';

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>formation</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
     
*{
   margin: 0;
   padding: 0;
}
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f0f0f0;
    color: #333;
    margin: 0;
    padding: 0;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

section.post-editor {
   width: 100%;
    max-width: 470px;
    height: 76%;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 90%;
    position: relative;
}

input[type="text"],
select {
   width: 100%;
    padding: 7px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 12px;
    transition: border-color 0.3s ease;
}



input[type="text"]:focus,
select:focus {
    outline: none;
    border-color: #0fbc7d;
}

.file-upload input[type="file"] {
    display: none;
}

.file-upload label {
    display: block;
    width: 100%;
    padding: 15px;
    text-align: center;
    background-color: #0fbc7d;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.file-upload label:hover {
    background-color: #0ca166;
}

.button {
    text-align: center;
}

.button input[type="submit"] {
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    background-color: #0fbc7d;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button input[type="submit"]:hover {
    background-color: #0ca166;
}

   input.inline-delete-btn {
      position: absolute;
      top: 328px;
      left: 1px;
      border: none;
      background: #eb2121de;
      font-size: 11px;
      color: white;
      width: 88px;
      height: 31px;
      border-radius: 8px;
      cursor: pointer;
   }

   .flex-btn {
    display: flex;
    gap: 10px;
    margin-top: 90px;
}

input.delete-btn {
    border: none;
    background: #ff000024;
    color: red;
    width: 100px;
    height: 30px;
    border-radius: 10px;
    cursor: pointer;
}
input.btn {
    border: none;
    background: #0fbc7d30;
    color: green;
    width: 100px;
    height: 30px;
    border-radius: 10px;
    cursor: pointer;
}
a.option-btn {
    border: none;
    background: #0093ff42;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0011ff;
    width: 100px;
    height: 30px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
    cursor: pointer;
}
video.attachment-video {
    position: absolute;
    top: 280px;
    right: -20px;
}
.boxx{
   position: absolute;
    top: 286px;
    left: 0;
}

@media (max-width: 480px) {
   video.attachment-video {
      top: 296px;
   }
}


    </style>
</head>
<body>

<section class="post-editor">
   

   <h1 class="heading">modifier</h1>

   <?php
      $formation = $_GET['id'];
      $select_formation = $conn->prepare("SELECT * FROM `formation` WHERE id = ?");
      $select_formation->execute([$formation]);
      // Vérification si la formation existe
      if($select_formation->rowCount() > 0){
         // Boucle while pour parcourir toutes les lignes de résultats
         while($fetch_formation = $select_formation->fetch(PDO::FETCH_ASSOC)){
   ?>
   <!-- Formulaire de modification de la formation -->
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_video" value="<?= $fetch_formation['video']; ?>">
      <input type="hidden" name="formation" value="<?= $fetch_formation['id']; ?>">
      
      <!-- Sélection de l'état de la formation -->
      <p>statut de la formation</p>
      <select name="status" class="box" required>
         <option value="<?= $fetch_formation['status']; ?>" selected><?= $fetch_formation['status']; ?></option>
         <option value="active">activer</option>
         <option value="deactive">désactiver</option>
      </select>

      <!-- Titre de la formation -->
      <p>titre de la formation</p>
      <input type="text" name="title" maxlength="100" required placeholder="ajouter un titre de formation" class="box" value="<?= $fetch_formation['title']; ?>">

      <!-- Public de la formation -->
      <p>public de la formation</p>
      <input type="text" name="public" maxlength="100" required placeholder="ajouter un public de formation" class="box" value="<?= $fetch_formation['public']; ?>">

      <!-- Exigences de la formation -->
      <p>exigences de la formation</p>
      <input type="text" name="Exigences" maxlength="100" required placeholder="ajouter des exigences de formation" class="box" value="<?= $fetch_formation['Exigences']; ?>">

      <!-- Champ pour téléverser une nouvelle vidéo -->
      <p>vidéo de la formation</p>
      <input type="file" name="video" class="boxx" accept="video/*">
      <!-- Affichage de la vidéo actuelle -->
      <?php if($fetch_formation['video'] != ''){ ?>
        <video controls class="attachment-video" style="width: 155px;">
                          <source src="../uploaded_videos/<?= $fetch_formation['video']; ?>" type="video/mp4" style="width:80px; height:80px;">
                          Votre navigateur ne prend pas en charge la balise vidéo.
                      </video>
         <!-- Bouton pour supprimer la vidéo -->
         <input type="submit" value="supprimer" class="inline-delete-btn" name="delete_video">
      <?php } ?>
      <!-- Boutons d'action -->
      <div class="flex-btn">
         <input type="submit" value="enregistrer" name="save" class="btn">
         <a href="list_formation.php" class="option-btn">retourner</a>
         <input type="submit" value="supprimer" class="delete-btn" name="delete_post">
      </div>
   </form>

   <?php
         }
      }else{
         // Si aucune formation n'est trouvée
         echo '<p class="empty">aucune formation trouvée!</p>';
   ?>
   <!-- Bouton pour revenir à la liste des formations -->
   <div class="flex-btn">
      <a href="list_formation.php" class="option-btn">voir la formation</a>
   </div>
   <?php
      }
   ?>

</section>



<script src="../js/script.js"></script>

</body>
</html>
