<?php
// Inclure le fichier de connexion à la base de données
include './components/connect.php';

// Démarrer la session
session_start();

// Vérifier si l'identifiant de l'étudiant est défini dans la session
if(isset($_SESSION['étudiant_id'])){
    $étudiant_id = $_SESSION['étudiant_id'];
}else{
    $étudiant_id = '';
};


?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Compétences</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="./css/style.css">

   <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eeeff36e;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
            text-align: center;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
            max-height: 400px; 
        }

        .card img {
            width: 100%;
            height: 200px; 
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }


        .card .info {
            padding: 20px;
        }

        .card .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card .content {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }
   </style>
</head>
<body>
   
    <div class="container">
        <h2 class="title">Annonce</h2>
        <?php
        $select_étudiant = $conn->prepare("SELECT * FROM `groups` WHERE étudiant_id = ?");
        $select_étudiant->execute([$étudiant_id]);
        if($select_étudiant->rowCount() > 0){
            while($fetch_étudiant = $select_étudiant->fetch(PDO::FETCH_ASSOC)){ 
                $formation_id = $fetch_étudiant['formation_id'];
            $select_annonce = $conn->prepare("SELECT * FROM `annonce` where formation_id = ?");
            $select_annonce->execute([$formation_id]);
            if($select_annonce->rowCount() > 0){
                $fetch_annonce = $select_annonce->fetch(PDO::FETCH_ASSOC);

        ?>
            <div class="card">
                <img src="./uploaded_img/<?= $fetch_annonce['image']; ?>" alt="Image">
                <div class="info">
                    <div class="title"><?= $fetch_annonce['title']; ?></div>
                    <p class="content"><?= $fetch_annonce['content']; ?></p>
                </div>
            </div>
        <?php }}} ?>
    </div>

    <script src="js/script.js"></script>
</body>
</html>

