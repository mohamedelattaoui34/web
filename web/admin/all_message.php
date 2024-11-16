<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($_SESSION['admin_id'])){
  header('location:login_admin.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body {
            width: 100%;
            height: 100vh;
        }
        .down-tabs {
            width: 100%;
            height: 90%;
            overflow: hidden;
        }
        .up-tabs {
            display: flex;
            height: 10%;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .con1, .con2 , .con3, .tab {
            width: 33.33%;
            display: flex;
            justify-content: center;
            align-items: center;
            border-top: 1px solid #cfcfcf;
            gap: 15px;
            font-size: 18px;
            cursor: pointer;
        }
        .dTab {
            width: 100%;
            height: 100%;
            overflow: scroll;
        }
        .dTab::-webkit-scrollbar{
            display: none;
        }
        .active{
            background: #0066ff;
            color: white;
            width: 33.33%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            font-size: 18px;
            cursor: pointer;
        }
        a{
            text-decoration: none;
            color: #000000b3;
            width: 100%;
            gap: 10px;
            max-width: 100%;
            display: flex;
            height: 65px;
            align-items: center;
            font-size: 20px;
        }
        i.fa-solid.fa-user-group {
            width: 45px;
            height: 45px;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-left: 15px;
        }
        img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-left: 15px;
        }
        @media (max-width: 480px) {
            .con1, .con2 , .con3, .tab , .active {
                font-size: 14px;
            }
            img {
                width: 45px;
                height: 45px;
                border-radius: 50%;
            }
            a{
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="down-tabs">
        <div id="con1" class="dTab">

                                 <?php
                                                $select_formation = $conn->prepare("SELECT * FROM `groups`");
                                                $select_formation->execute();
                                                if($select_formation->rowCount() > 0){
                                                while($fetch_formation = $select_formation->fetch(PDO::FETCH_ASSOC)){
                                                    $formation_id = $fetch_formation['formation_id'];

                                                    
                                                $select_Enseignants = $conn->prepare("SELECT * FROM `formation` WHERE id = ?");
                                                $select_Enseignants->execute([$formation_id]);
                                                    if($select_Enseignants->rowCount() > 0){
                                                    $fetch_Enseignants = $select_Enseignants->fetch(PDO::FETCH_ASSOC)

                                            ?>
                                            <a href="message.php?formation_id=<?= $formation_id; ?>">
                                            <i class="fa-solid fa-user-group"></i>
                                            <p><?=  $fetch_Enseignants['title'];  ?></p>
                                            </a>
                <?php  }}}  ?>

        </div>
        <div id="con2" class="dTab" style="display: none;">

        <?php

                                        $select_groups = $conn->prepare("SELECT DISTINCT étudiant_id FROM  `message_étudiant_admin` WHERE admin_id = ?");
                                        $select_groups->execute([$admin_id]);
                                            if($select_groups->rowCount() > 0){
                                            while($fetch_groups = $select_groups->fetch(PDO::FETCH_ASSOC)){
                                                $étudiant_id = $fetch_groups['étudiant_id'];


                                                $select_étudiant = $conn->prepare("SELECT * FROM `étudiant` WHERE id = ?");
                                                $select_étudiant->execute([$étudiant_id]);
                                                    if($select_étudiant->rowCount() > 0){
                                                    $fetch_étudiant = $select_étudiant->fetch(PDO::FETCH_ASSOC)
                                            ?>
                                            <a href="mes_por_étudiant.php?étudiant_id=<?= $étudiant_id; ?>">                                                 
                                            <?php
                                                        if($fetch_étudiant['image'] != ''){  
                                                    ?>
                                                    <img src="../uploaded_img/<?= $fetch_étudiant['image']; ?>" alt="">
                                                    <?php 
                                                }else {
                                            ?>            
                                                    <img src="img/chico.jpg" alt="" >     
                                            <?php 
                                                }
                                            ?>

                                                <p><?=  $fetch_étudiant['name'];  ?></p>
                                            </a>
                                            <?php  }}}  ?>

                                </div>
                                    <div id="con3" class="dTab" style="display: none;">
                                    <?php
                                                $select_admine = $conn->prepare("SELECT DISTINCT Enseignants_id FROM `message_Enseignants_admin` WHERE admin_id = ?");
                                                $select_admine->execute([$admin_id]);
                                                if($select_admine->rowCount() > 0){
                                                while($fetch_admine = $select_admine->fetch(PDO::FETCH_ASSOC)){
                                                    $Enseignants_id = $fetch_admine['Enseignants_id'];

                                                    $select_Enseignants = $conn->prepare("SELECT * FROM `Enseignants` WHERE id = ?");
                                                $select_Enseignants->execute([$Enseignants_id]);
                                                    if($select_Enseignants->rowCount() > 0){
                                                    $fetch_Enseignants = $select_Enseignants->fetch(PDO::FETCH_ASSOC)

                                            ?>
                                            <a href="message_por_ens.php?Enseignants_id=<?= $Enseignants_id; ?>">
                                                
                                                <?php
                                                        if($fetch_Enseignants['image'] != ''){  
                                                    ?>
                                                    <img src="../uploaded_img/<?= $fetch_Enseignants['image']; ?>" alt="" >
                                                    <?php 
                                                }else {
                                            ?>            
                                                    <img src="img/chico.jpg" alt="">     
                                            <?php 
                                                }
                                            ?>
                                            <p><?=  $fetch_Enseignants['name'];  ?></p>
                                            </a>
                <?php  }}}  ?>
    </div>
    </div>
    <div class="up-tabs">
        <div id="active"  class="active"><i class="fa-solid fa-users"></i>Les groupes</div>
        <div id="two" class="tab"><i class="fa-solid fa-user-graduate"></i>Les étudients</div>
        <div id="three" class="tab"><i class="fa-solid fa-user-tie"></i>L'Enseignants</div>
    </div>

    <script>
        let one   = document.getElementById("active"); 
        let two   = document.getElementById("two"); 
        let three = document.getElementById("three");
        let con1  = document.getElementById("con1"); 
        let con2  = document.getElementById("con2");
        let con3  = document.getElementById("con3");

        one.addEventListener("click" , function() {
            con1.style.display = "block";
            con2.style.display = "none";
            con3.style.display = "none";
            one.classList.add("active");
            two.classList.replace("active" , "con2");
            three.classList.replace("active" , "con3");
            
        });
        two.addEventListener("click" , function() {
            con2.style.display = "block";
            con1.style.display = "none";
            con3.style.display = "none";
            two.classList.add("active");
            one.classList.replace("active" , "con1");
            three.classList.replace("active" , "con3");
        });
        three.addEventListener("click" , function() {
            con3.style.display = "block";
            con1.style.display = "none";
            con2.style.display = "none";
            three.classList.add("active");
            two.classList.replace("active" , "con2");
            one.classList.replace("active" , "con1");
        });
    </script>
</body>
</html>