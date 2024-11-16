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
    <title>profile</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body {
            width: 100%;
            height: 100vh;
        }
        .Container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .backCover {
            width: 100%;
            height: 30%;
            background: linear-gradient(45deg, #266aff, #2ce7ff);
        }
        .Conc{
            width: 100%;
            height: 70%;
        }
        
        .content {
            width: 100%;
            height: 100%;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .conImg{
            background: white;
            position: absolute;
            top: -87px;
            left: 25%;
            border-radius: 50%;
            width: 11rem;
            height: 11rem;
            border: 0.3rem solid #fff;
        }
        img.img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }
        p.Etudient {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 31px;
            margin-top: 120px;
            color: #666666;
            font-weight: bold;
        }
        .edit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            font-size: 18px;
        }
        i.fa-solid.fa-pen-to-square {
            color: #2783ff;
        }
        p {
            color: #a4a4a4;
        }
        a {
            text-decoration: none;
        }
        a.ConNmbr {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 13px;
            font-size: 21px;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        p.bienvenue {
            margin-top: 14px;
            text-align: center;
            font-size: 17px;
            color: #585858;
        }
        
        p.dema {
            font-size: 12px;
            margin: 9px 6px;
            font-family: auto;
            color: #000000c7;
        }
        i.fa-solid.fa-arrow-right {
            position: absolute;
            top: 1%;
            right: 3%;
            color: white;
            font-size: 30px;
        }
        i.fas.fa-right-from-bracket {
            position: absolute;
            top: 1%;
            left: 3%;
            color: white;
            font-size: 30px;
        }
        i.fa-solid.fa-bell {
            position: absolute;
            top: 4%;
            left: 9%;
            color: #ff4086;
            font-size: 35px;
        }
        i.fa-solid.fa-comment {
            position: absolute;
            top: 4%;
            right: 9%;
            color: #d782d9;
            font-size: 33px;
        }
        .Viewmore {
            width: 107px;
            height: 48px;
            border-radius: 50px;
            background: #2196F3;
            font-size: 21px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
        }
        i.fa-solid.fa-camera {
            position: absolute;
            top: 1px;
            right: 15px;
            color: black;
            background: white;
            padding: 7px;
            border-radius: 50%;
            z-index: 0;
        }
        @media (min-width: 480px) {
            .Conc{
                position: relative;
            }
            .content {
                display: flex;
                align-items: center;
                padding-bottom: 26px;
                width: 68%;
                height: 461px;
                top: -90px;
                left: 17%;
                position: absolute;
                background: white;
                border-radius: 10px;
                box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
            }
            .conImg {
                margin-top: 40px;
                background: white;
                border-radius: 50%;
                width: 10rem;
                height: 10rem;
                min-height: 10rem;
                box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
                position: unset;
                border: 0;
            }
            p.Etudient{
                margin-top: 20px;
            }
            i.fa-solid.fa-arrow-right {
                position: absolute;
                top: 18%;
                right: 19%;
                color: #277bff;
                font-size: 30px;
                z-index: 2;
                cursor: pointer;
            }
            i.fas.fa-right-from-bracket {
                position: absolute;
                top: 18%;
                left: 20%;
                color: #ef2c2c;
                font-size: 27px;
                z-index: 2;
                cursor: pointer;
            }
            i.fa-solid.fa-bell {
                position: absolute;
                top: 35%;
                left: 28%;
                color: #ff4086;
                font-size: 35px;
                cursor: pointer;
            }
            i.fa-solid.fa-comment {
                position: absolute;
                top: 35%;
                right: 28%;
                color: #d782d9;
                font-size: 35px;
                cursor: pointer;
            }
            i.fa-solid.fa-camera {
                position: absolute;
                top: 44px;
                right: 42%;
                color: black;
                background: white;
                border: 1px solid #eee;
                padding: 7px;
                border-radius: 50%;
                cursor: pointer;
            }

        }

        @media screen and (min-width: 480px) and (max-width: 750px) {
                i.fa-solid.fa-bell {
                position: absolute;
                top: 36%;
                left: 21%;
                color: #2196F3;
                font-size: 31px;
                cursor: pointer;
            }
            i.fa-solid.fa-comment {
                position: absolute;
                top: 36%;
                right: 19%;
                color: #2196F3;
                font-size: 27px;
                cursor: pointer;
            }
            i.fa-solid.fa-camera {
                position: absolute;
                top: 44px;
                right: 34%;
                color: black;
                background: white;
                border: 1px solid #eee;
                padding: 7px;
                border-radius: 50%;
                cursor: pointer;
            }
        }
        @media screen and (min-width: 750px) and (max-width: 1000px) {
            i.fa-solid.fa-camera{
                right: 40%;
            }
        }


        div#noti {
            font-size: 9px;
            color: black;
            background: white;
            z-index: 3;
            display: flex;
            position: absolute;
            width: 227px;
            height: 269px;
            border-radius: 10px;
            box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
        }
        .bita {
            width: 88%;
            display: flex;
            align-items: center;
            justify-content: start;
            margin-left: 14px;
            height: 30px;
            border-bottom: 1px solid #eee;
            font-family: sans-serif;
            font-size: 13px;
            color: #2783ff;
        }
        .ko {
            height: 100%;
        }
        .libri {
            overflow: scroll;
            height: 87%;
        }

    </style>
</head>
<body>
    <div class="Container">
        <div class="backCover">
            <a href="dashboard.php"><i class="fa-solid fa-arrow-right"></i></a>
            <a href="lokot.php" onclick="return confirm('vous déconnecter de ce site?');"><i class="fas fa-right-from-bracket"></i></a>
        </div>
        <div class="Conc">

            <div class="content">
            <i onclick="ouv();" id="bell" class="fa-solid fa-bell">
                    <div id="noti" style="display: none;" class="notification">
                    <div class="ko">
                        <span class="bita">notification</span>
                        <div class="libri">
                        <?php

            $select_formation = $conn->prepare("SELECT * FROM `formation`");
            $select_formation->execute();
                if($select_formation->rowCount() > 0){
                while($fetch_formation = $select_formation->fetch(PDO::FETCH_ASSOC)){
                $Enseignants_id = $fetch_formation['Enseignants_id'];

                $select_Enseignants = $conn->prepare("SELECT * FROM `Enseignants` WHERE id = ?");
            $select_Enseignants->execute([$Enseignants_id]);
            if($select_Enseignants->rowCount() > 0){
                $fetch_Enseignants = $select_Enseignants->fetch(PDO::FETCH_ASSOC);
?>
<p class="dema">
Il a créé <?= $fetch_Enseignants['name']; ?> formation <?= $fetch_formation['title']; ?> <?= $fetch_formation['date']; ?>
</p>
<?php }} } ?>
                        </div>
                    </div>
                    </div>
                </i>
                <a href="all_message.php"><i class="fa-solid fa-comment"></i></a>
                
        <?php
            
            $select_profile = $conn->prepare("SELECT * FROM `admine` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>

                <div class="conImg">
                <a href="edit_photo.php?admin_id=<?= $admin_id; ?>"><i class="fa-solid fa-camera"></i></a>
                <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" alt="" class="img">
                </div>
                    <p class="Etudient"><?= $fetch_profile['name']; ?></p>

                    <div class="edit">
                        <p><?= $fetch_profile['email']; ?></p>
                    </div>
                    <?php  }?>
                    <a href="" class="ConNmbr">
                    <span class="Numero"><?= $fetch_profile['Numéro']; ?></p></span>
                    </a>
                    <p class="bienvenue">Bienvenue dans votre compte</p>
                    <a href="update.php">
                        <div class="Viewmore">modifier</div>
                    </a>   
           </div>
        </div>

    </div>
    
    <script>
        function ouv() {
            let noti = document.getElementById('noti');
            if (noti.style.display === 'none'){
                noti.style.display = "block";
            } else {
                noti.style.display = "none";
            }
        }
    </script>
</body>
</html>