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


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Enseignants</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


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

.contlecons img {
    width: 100%;
    height: 200px;
    object-fit: cover;
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

    .contlecons img {
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

a.matiereDuProf {
    text-decoration: none;
    color: #7c7c7c;
}

</style>
</head>
<body>
   
    <div class="li">
        <h2 class="titers">Les Enseignants</h2>
    </div>
    


   
   <div class="divEnse">
            <?php
                         $select_Enseignants = $conn->prepare("SELECT * FROM `Enseignants`");
                         $select_Enseignants->execute();
                         if($select_Enseignants->rowCount() > 0){
                         while($fetch_Enseignants = $select_Enseignants->fetch(PDO::FETCH_ASSOC)){ 
                            
                    ?>

            <div class="contlecons">
           
<?php
            if($fetch_Enseignants['image'] != ''){  
         ?>
         
         <img src="./uploaded_img/<?= $fetch_Enseignants['image']; ?>" alt="" style="width: 100%;height: 235px;">
         <?php 
    }else {
?>
               
        <img src="./img/chico.jpg" alt="" style="width: 100%;height: 235px;">
        

        
        
<?php 
    
}
?>
    <div class="infole">
        <div class="courtitre"><?= $fetch_Enseignants['name']; ?></div>
        <a href="tel:<?= $fetch_Enseignants['Numéro']; ?>" class="matiereDuProf"><i class="fa-solid fa-phone"></i> : <?= $fetch_Enseignants['Numéro']; ?></a>


    </div>
</div>
<?php }} ?>




</div>







<script src="js/script.js"></script>

</body>
</html>