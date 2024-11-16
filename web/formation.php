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
        <h2 class="titers">Les formation</h2>
    </div>
    


   
   <div class="divEnse">
            <?php
                         $select_groups = $conn->prepare("SELECT * FROM `groups` WHERE étudiant_id = ?");
                         $select_groups->execute([$étudiant_id]);
                         if($select_groups->rowCount() > 0){
                         while($fetch_groups = $select_groups->fetch(PDO::FETCH_ASSOC)){


                            $select_formation = $conn->prepare("SELECT * FROM `formation` WHERE Enseignants_id = ?");
                         $select_formation->execute([$fetch_groups['Enseignants_id']]);
                         if($select_formation->rowCount() > 0){
                         $fetch_formation = $select_formation->fetch(PDO::FETCH_ASSOC);

                            
                         
                    ?>

            <div class="contlecons">
    <video controls class="leconfimg">
        <source src="./uploaded_videos/<?= $fetch_formation['video']; ?>" type="video/mp4">
    </video>
    <div class="infole">
        <div class="courtitre"><?= $fetch_formation['title']; ?></div>
        <p class="desctiti"><?= $fetch_formation['liés']; ?></p>
        
        <div class="do">
            <div class="Prix"><?= $fetch_formation['Exigences']; ?> <i class="fa-solid fa-sack-dollar"></i></div>
            <div class="but"><?= $fetch_formation['public']; ?> <i class="fa-solid fa-users"></i></div>
        </div>
    </div>
</div>
<?php }}} ?>




</div>







<script src="js/script.js"></script>

</body>
</html>