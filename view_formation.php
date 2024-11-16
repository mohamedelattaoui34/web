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

// Vérifier si le formulaire a été soumis pour ajouter une demande

 if(isset($_POST['ajoute'])){
    // Récupérer les données du formulaire et les filtrer

    $formation_id = $_POST['formation_id'];
    $formation_id = filter_var($formation_id, FILTER_SANITIZE_STRING);
    $Enseignants_id = $_POST['Enseignants_id'];
    $Enseignants_id = filter_var($Enseignants_id, FILTER_SANITIZE_STRING);
  
     // Préparer et exécuter la requête d'insertion dans la base de données

       $insert_post = $conn->prepare("INSERT INTO `demanders`(étudiant_id, formation_id, Enseignants_id, demander) VALUES(?,?,?,1)");
       $insert_post->execute([$étudiant_id, $formation_id, $Enseignants_id]);
       $message[] = 'draft saved!';
    
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
   <link rel="stylesheet" href="./css/style.css">

   <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #eeeff36e;
        margin: 20px;
    }

    .li {
        text-align: center;
        margin-bottom: 20px;
    }

    .titers {
        font-size: 24px;
        color: #333;
    }

    .divEnse {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .contlecons {
        width: calc(33.33% - 20px); 
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .contlecons:hover {
        transform: translateY(-5px);
    }

    .contlecons video {
        width: 100%;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .infole {
        padding: 15px;
    }

    .courtitre {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .desctiti {
        color: #666;
        font-size: 14px;
    }

    @media screen and (max-width: 768px) {
        .divEnse {
            justify-content: center; 
        }

        .contlecons {
            width: calc(100% - 20px); 
        }

        .contlecons video {
            height: 200px;
        }

        .infole {
            padding: 15px; 
        }

        .courtitre {
            font-size: 18px; 
        }

        .desctiti {
            font-size: 14px; 
        }
    }
</style>



</head>
<body>
   
    <div class="li">
        <h2 class="titers">Les Lecons</h2>
    </div>
    


   
   <div class="divEnse">
            <?php
                         $select_formation = $conn->prepare("SELECT * FROM `formation`");
                         $select_formation->execute();
                         if($select_formation->rowCount() > 0){
                         while($fetch_formation = $select_formation->fetch(PDO::FETCH_ASSOC)){ 
                             $formation_id = $fetch_formation['id'];

                             $formation_cl = $conn->prepare("SELECT * FROM `demanders` WHERE formation_id = ? AND étudiant_id = ?");
                             $formation_cl->execute([$formation_id, $étudiant_id]);
                         
                    ?>

            <div class="contlecons">
    <video controls class="leconfimg">
        <source src="./uploaded_videos/<?= $fetch_formation['video']; ?>" type="video/mp4">
    </video>
    <div class="infole">
        <div class="courtitre"><?= $fetch_formation['title']; ?></div>
        <p class="desctiti"><?= $fetch_formation['liés']; ?></p>
        <form action="" method="POST">
            <input type="hidden" name="formation_id" value="<?= $fetch_formation['id']; ?>">
            <input type="hidden" name="Enseignants_id" value="<?= $fetch_formation['Enseignants_id']; ?>">
            <button type="submit" class="join" name="ajoute" style="<?php if($formation_cl->rowCount() > 0){ echo 'display:none;'; } ?>  ">joindre</button>
        </form>
        <div class="do">
            <div class="Prix"><?= $fetch_formation['Exigences']; ?> <i class="fa-solid fa-sack-dollar"></i></div>
            <div class="but"><?= $fetch_formation['public']; ?> <i class="fa-solid fa-users"></i></div>
        </div>
    </div>
</div>
<?php }} ?>




</div>







<script src="js/script.js"></script>

</body>
</html>