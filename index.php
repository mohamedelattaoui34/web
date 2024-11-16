

<?php

include './components/connect.php';

session_start();


if(isset($_SESSION['étudiant_id'])){
    $étudiant_id = $_SESSION['étudiant_id'];
 }else{
    $étudiant_id = '';
 };


 if(isset($_POST['ajoute'])){

    $formation_id = $_POST['formation_id'];
    $formation_id = filter_var($formation_id, FILTER_SANITIZE_STRING);
    $Enseignants_id = $_POST['Enseignants_id'];
    $Enseignants_id = filter_var($Enseignants_id, FILTER_SANITIZE_STRING);
  
 
    $check_duplicate = $conn->prepare("SELECT COUNT(*) FROM `demanders` WHERE étudiant_id = ? AND formation_id = ?");
    $check_duplicate->execute([$étudiant_id, $formation_id]);
    
    $count_duplicate = $check_duplicate->fetchColumn();
    
    if ($count_duplicate > 0) {
        $warning_msg[] = '';
        
    
    } else {
       $insert_post = $conn->prepare("INSERT INTO `demanders`(étudiant_id, formation_id, Enseignants_id, demander) VALUES(?,?,?,1)");
       $insert_post->execute([$étudiant_id, $formation_id, $Enseignants_id]);
       $message[] = 'draft saved!';
    
  }
 }


 if(isset($_POST['envoyer'])){

    $messa = $_POST['messa'];
    $messa = filter_var($messa, FILTER_SANITIZE_STRING);

       $insert_post = $conn->prepare("INSERT INTO `contact`(messa) VALUES(?)");
       $insert_post->execute([$messa]);
       $message[] = 'draft saved!';
    
  }
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <title>index</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        .hheader {
            display: flex;
            justify-content: space-around;
            width: 100%;
            height: 60px;
            box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
        }
        .logoCoon {
            width: 20%;
        }
        .siwi {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            gap: 18px;
            direction: rtl;
            font-size: 19px;
        }
        
        .nav {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 51%;
            gap: 17px;
        }
        .navcontent {
            border-radius: 0px;
            font-size: 16px;
            color: gray;
            width: 95px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .navcontent:hover{
            background: #12a2e9;
            color: white;
            border-radius: 5px;
            transition: .5s ease;
            padding: 1px 5px;
        }

        .font-Ecran {
            width: 100%;
            height: 550px;
            position: relative;
        }
        .divImg {
            width: 100%;
            height: 100%;
        }
        img {
            width: 100%;
            height: 100%;
            filter: brightness(0.5);
        }
        h1 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            color: white;
            font-size: 40px;
            width: 73%;
            text-align: center;
        }
        button.inli {
            background: 000;
            color: white;
            border: none;
        }
        .fontP {
            position: absolute;
            top: 58%;
            left: 50%;
            transform: translate(-50%, 0);
            z-index: 2;
            color: white;
        }
        .autres {
            width: 100%;
            height: 330px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 89px;
        }
        .auterContent {
            background: #b2dfdf21;
            width: 70%;
            height: 224px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0px 10px;
            font-size: 19px;
            color: black;
        }
        i.fa-solid.fa-book , i.fa-solid.fa-bullhorn{
            font-size: 46px;
            color: #00a1ff;
        }
        .paute{
            font-size: 13px;
            text-align: center;
        }
        h3.tit {
            margin-top: 10px;
        }
        .auterContent:hover{
            background: #12a2e9;
            color: white;
            border-radius: 5px;
            transition: .5s ease;
            padding: 2px 12px;
            i.fa-solid.fa-book , i.fa-solid.fa-bullhorn  {
                color: white;
            }
        }

        .contEnsei {
            width: 19%;
            height: 259px;
            box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
        }
        img.profimg {
            height: 70%;
        }
        .info {
            height: 21%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        .nomDuProf {
            font-weight: bold;
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            font-size: 15px;
            text-align: center;
        }


        .infole {
            height: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            padding: 0px 21px;
            text-align: center;
        }
        .courtitre {
            font-size: 19px;
            font-weight: bold;
        }
        p.desctiti {
            word-break: break-all;
            width: 212px;
            height: 55px;
            overflow: scroll;
            overflow-x: hidden;
        }
        .desctiti::-webkit-scrollbar {
            display: none;
        }
        .join {
            background: #00a1ff;
            border: none;
            color: white;
            width: 90px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
        }
        img.leconfimg {
            height: 50%;
        }
        .do {
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 44%;
            margin-bottom: 10px;
        }
        .Prix , .but {
            direction: rtl;
            display: flex;
            gap: 3px;
        }
        a.matiereDuProf {
            gap: 10px;
            width: 100%;
            color: #333333d1;
            font-size: 15px;
        }
        footer {
            width: 100%;
            height: 300px;
            background: #181d38;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5%;
            color: white;
        }
        .footliens , .footcontact{
            width: 20%;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 9px;
        }
        .footnotre {
            gap: 10px;
            display: flex;
            flex-direction: column;
        }
        .input {
            background: white;
            padding: 7px;
            border-radius: 3px;
        }
        input[type="email"] {
            color: black;
            outline: none;
            border: none;
            padding-left: 10px;
        }
        button.send {
            border: none;
            padding: 8px;
            border-radius: 5px;
            background: #00a1ff;
            color: white;
        }
        .meme {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 6px;
        }
        video.leconfimg {
            width: 100%;
            height: 48%;
            background: black;
        }
        a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            text-decoration: none;
            color: white;
            font-size: 13px;
        }
        input[type="text"] {
            border: none;
            outline: unset;
            width: 71%;
        }
        i.fa-solid.fa-sack-dollar {
            color: gold;
        }
        .viewdiv {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 24px;
            margin-bottom: 35px;
        }
        .contactes {
            display: flex;
            gap: 10px;
        }

        a.view {
            background: #00a1ff;
            width: 108px;
            height: 41px;
            border-radius: 11px;
            color: white;
            font-size: 16px;
            font-weight: bold;
        }
        i.fa-solid.fa-bars {
            display: none;
        }
        
            .divEnsee {
                height: 400px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 4%;
                padding: 0px 25px;
            }
        @media (max-width: 770px) {
            footer {
                height: 260px;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                font-size: 11px;
                position: relative;
            }
            .footliens {
                position: absolute;
                width: 40%;
                justify-content: flex-start;
                top: 31px;
                left: 20px;
                font-size: 16px;
            }
            .footcontact{
                position: absolute;
                width: 40%;
                justify-content: flex-start;
                top: 31px;
                right: 0px;
                font-size: 16px;
            }
            .footnotre {
                gap: 10px;
                display: flex;
                flex-direction: column;
                position: absolute;
                bottom: 4px;
                right: 33px;
            }
            .do{
                gap: 16%;
                font-size: 13px;
            }

            
        }

        @media (max-width: 480px) {
            i.fa-solid.fa-bars, i.fa-solid.fa-ellipsis-vertical {
                display: block;
                font-size: 22px;
            }
            .nav{
                display: none;
            }
            .autres {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                height: 290px;
                justify-content: center;
                align-items: center;
                justify-items: center;
                gap: 0px;
            }
            .auterContent{
                width: 80%;
                height: 170px;

            }
            i.fa-solid.fa-graduation-cap, i.fa-solid.fa-globe, i.fa-solid.fa-house-chimney, i.fa-solid.fa-book-open{
                font-size: 30px;
            }
            .paute{
                font-size: 11px;
            }
            .divEnse {
                padding-top: 20px;
                width: 100%;
                height: 247px;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                align-items: center;
                gap: 3%;
                justify-content: center;
                justify-items: center;
                overflow: hidden;
            }
            .divEnsee {
                padding-top: 20px;
                display: flex;
                gap: 20px;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                justify-items: center;
                overflow: hidden;
                height: unset;
                padding: 4px 0px;
            }
            .contlecons {
                width: 90%;
            }

            .infole{
                padding: 0;
            }
            .do {
                width: 92%;
                display: flex;
                justify-content: center;
                gap: 25%;
                margin-bottom: 10px;
                font-size: 16px;
            }
            .but {
                overflow: auto;
                white-space: nowrap;
                text-overflow: clip;
                width: 120px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .contEnsei{
                width: 93%;
                height: 245px;
            }
            p.desctiti{
                width: 100%;
            }
            footer {
                height: 260px;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                font-size: 11px;
                position: relative;
            }
            .footliens {
                position: absolute;
                width: 40%;
                justify-content: flex-start;
                top: 31px;
                left: 20px;
            }
            .footcontact{
                position: absolute;
                width: 40%;
                justify-content: flex-start;
                top: 31px;
                right: 0px;
            }
            .footnotre {
                gap: 10px;
                display: flex;
                flex-direction: column;
                position: absolute;
                bottom: 4px;
                left: 20px;
            }
            .logoCoon {
                width: 38%;
            }
            input[type="email"]{
                width:74%;
            }
            a{
                    width: 100%;
            }
        }

        .divDots{
            width: 232px;
            display: block;
            position: absolute;
            background: white;
            padding: 19px;
            z-index: 3;
            font-size: 10px;
            font-family: auto;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 30px 90px;
            border-radius: 5px;
        }

        .divBars{
            display: block;
            position: absolute;
            background: white;
            width: 217px;
            z-index: 3;
            font-size: 10px;
            font-family: auto;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 30px 90px;
            border-radius: 5px;
            gap: 10px;
            flex-direction: column;
            padding: 11px;
        }
        a.kla {
            padding: 10px 0px;
            font-size: 16px;
            color: #0000008a;
            direction: ltr;
            gap: 9px;
            justify-content: start;
            width: 100%;
        }

        a.klaa {
        text-align: center;
        direction: ltr;
        padding: 8px 0px;
        font-size: 16px;
        color: #0000008a;
        }
        
        a.liens {
            color: white;
            gap: 10px;
            display: flex;
            justify-content: flex-start;
            font-size: 16px;
        }
        
        i.fa-solid.fa-magnifying-glass {
            color: black;
        }
    </style>

</head>
<body>
    <div class="hheader">
        <div class="logoCoon">
            <img src="./juju.jpg" alt="" style="filter: unset;">
        </div>
        <div class="nav">
            <a href="index.php" class="navcontent">principale</a>
            <a href="About.php" class="navcontent">À propos</a>
            <a href="Enseignants.php" class="navcontent">Enseignants</a>
            <a href="view_formation.php" class="navcontent">Formation</a>
            <a href="contact.php" class="navcontent">Contact</a>
        </div>

        <div class="siwi">
            <i style="position: relative; cursor: pointer;" onclick="kilo();" class="fa-solid fa-ellipsis-vertical">
                <div style="display: none;" class="divDots">
                    <a class="kla" href="login_étudiant.php"><i class="fa-solid fa-user-graduate"></i> se connecte étudiant</a>
                    <a class="kla" href="./Enseignants/login_Enseignant.php"><i class="fa-solid fa-user-tie"></i> se connecte Enseignants</a>
                    <a class="kla" href="./admin/login_admin.php"><i class="fa-solid fa-user-tie"></i> se connecte Administration</a>

                </div>
            </i>

            <i style="position: relative; cursor: pointer;" onclick="kiloo();"  class="fa-solid fa-bars">
                <div style="display: none;" class="divBars">
                    <a class="klaa" href="index.php">page principale</a>
                    <a class="klaa" href="About.php">À propos</a>
                    <a class="klaa" href="Enseignants.php">Enseignants</a>
                    <a class="klaa" href="view_formation.php">Formation</a>
                    <a class="klaa" href="contact.php">Contactez-nous</a>
                </div>
            </i>
                    <a href="./étudiant/profile.php">

                <?php
                    
                    $select_profile = $conn->prepare("SELECT * FROM `étudiant` WHERE id = ?");
                    $select_profile->execute([$étudiant_id]);
                    if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <?php
                    if($fetch_profile['image'] != ''){  
                ?>
                <img src="./uploaded_img/<?= $fetch_profile['image']; ?>" alt="" style="width:45px; min-width: 45px; height: 45px;; border-radius:50%; filter: unset;">
                <?php 
                    }else {
                ?>          
                        <img src="./img/chico.jpg" alt="" style="width:45px; height:45px; border-radius:50%; filter: unset;">
                <?php 
                    }
                }
                ?>

        </a>
        <a href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>

    </div>
    <div class="font-Ecran">
        <div class="divImg">
            <img src="./class.jpg" alt="">
        </div>
        <h1>Online Education</h1>
        <h3 class="fontP">
            L'équipe pédagogique souhaite aux étudiants un début d'études fructueux et 
            les encourage à explorer et à réaliser leurs objectifs éducatifs.
        </h3>
    </div>
    <div class="autres">
           <a href="annonce.php">
        <div class="auterContent">
     <i class="fa-solid fa-bullhorn"></i>
                    <h3 class="tit">annonce</h3>
            <p class="paute"></p>
        </div>  
        </a>

        <a href="formation.php">
        <div class="auterContent">
      <i class="fa-solid fa-book"></i>
            <h3 class="tit">online courses</h3>
            <p class="paute"></p>
        </div>
       </a>
    </div>


    <h4 class="ensei">Les formation</h4>


    <div class="divEnsee">
            <?php
                        $select_formation = $conn->prepare("SELECT * FROM `formation` LIMIT 4");
                        $select_formation->execute();
                        if($select_formation->rowCount() > 0){
                        while($fetch_formation = $select_formation->fetch(PDO::FETCH_ASSOC)){ 
                            $formation_id = $fetch_formation['id'];

                            $formation_cl = $conn->prepare("SELECT * FROM `demanders` WHERE formation_id = ? AND étudiant_id = ?");
                            $formation_cl->execute([$formation_id, $étudiant_id]);
                        
                    ?>

            <div class="contlecons">
                <video controls  class="leconfimg">
                <source src="./uploaded_videos/<?= $fetch_formation['video']; ?>" type="video/mp4">
                                </video>
                    <div class="infole">
                        <div class="courtitre"><?= $fetch_formation['title']; ?></div>
                        <p class="desctiti"><?= $fetch_formation['liés']; ?></p>
                        <form action="" method="POST">
                                <input type="hidden" name="formation_id" value="<?= $fetch_formation['id']; ?>" required>
                                <input type="hidden" name="Enseignants_id" value="<?= $fetch_formation['Enseignants_id']; ?>">
                                <button type="submit" class="join" name="ajoute" style="<?php if($formation_cl->rowCount() > 0){ echo 'display:none;'; } ?>  ">joindre</button>
                                </form>
                        <div class="do">
                            <div class="Prix"><?= $fetch_formation['Exigences']; ?> <i class="fa-solid fa-sack-dollar"></i></div>
                            <div class="but"><?= $fetch_formation['public']; ?> <i class="fa-solid fa-users"></i></div>
                        </div>
                    </div>
            </div>
            <?php }}   ?>


</div>

<div class="viewdiv">
    <a class="view" href="view_formation.php">tout voir</a>
</div>


    <h4 class="ensei">Les Enseignurs</h4>

    <div class="divEnse">
    <?php
                         $select_Enseignants = $conn->prepare("SELECT * FROM `Enseignants` LIMIT 4");
                         $select_Enseignants->execute();
                         if($select_Enseignants->rowCount() > 0){
                         while($fetch_Enseignants = $select_Enseignants->fetch(PDO::FETCH_ASSOC)){ 
                            
                    ?>
        <div class="contEnsei">
                <?php
                    if($fetch_Enseignants['image'] != ''){  
                ?>
                
                <img src="./uploaded_img/<?= $fetch_Enseignants['image']; ?>" alt="" style="width: 100%;height: 179px;">
                <?php 
            }else {
            ?>
                        
                    <img src="./img/chico.jpg" alt="" style="width: 100%;height: 179px;">
                    

                    
                    
            <?php 
                
            } ?>
            <div class="info">
                <div class="nomDuProf"><?= $fetch_Enseignants['name']; ?></div>
                <a href="tel:<?= $fetch_Enseignants['Numéro']; ?>" class="matiereDuProf"><i class="fa-solid fa-phone"></i> <?= $fetch_Enseignants['Numéro']; ?></a>

            </div>
        </div>
        <?php  }}  ?>
    </div>

<div class="viewdiv">
    <a class="view" href="Enseignants.php">tout voir</a>
</div>

<div>


              
</div>
    <footer>
        <div class="footliens">
            <div class="meme">Liens</div>
            <a href="About.php" class="liens"><i class="fa-solid fa-chevron-right"></i>À propos</a>
            <a href="contact.php" class="liens"><i class="fa-solid fa-chevron-right"></i> Contactez-nous</a>
        </div>
        <div class="footcontact">
            <div class="meme">Contact</div>
            <div class="contactes"><i class="fa-solid fa-location-dot"></i>
            <a href="https://maps.app.goo.gl/exSbL868Mxszk9U18" style="justify-content: unset; color: white;"> École en Ligne, 123 Rue de l'Éducation, Tetueon, maroc</a></div>
            <div class="contactes"><i class="fa-solid fa-phone"></i> <a style="justify-content: unset; color: white;" href="tel:+212 647 452 397"> +212 647 452 397</a></div>
            <div class="contactes"><i class="fa-solid fa-envelope"></i></i> <a style="justify-content: unset; color: white;" href="mailto:contact@gmail.com">contact@gmail.com</a></div>
           

        </div>
        <div class="footnotre">
        <p class="meme">Contact us</p>
            <form action="" method="post" class="input">
                <input type="text" name="messa" placeholder="votre email...">
                <button class="send" type="submit" name="envoyer">envoyer</button>
            </form>
        </div>
    </footer>


    <script>
    function kilo(){
        let dots = document.querySelector(".divDots");
        let bars = document.querySelector(".divBars");
        if (dots.style.display === "none"){
            dots.style.display = "block";
        } else {
            dots.style.display = "none";
        }
        bars.style.display = "none";
    }
    function kiloo(){
        let bars = document.querySelector(".divBars");
        let dots = document.querySelector(".divDots");
        if (bars.style.display === "none"){
            bars.style.display = "flex";
        } else {
            bars.style.display = "none";
        }
        dots.style.display = "none";
    }
</script>

</body>
</html>



























