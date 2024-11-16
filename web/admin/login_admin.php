
<?php

include '../components/connect.php';
ob_start(); 

session_start();

if(isset($_SESSION['admin_id'])){
  header('location: dashboard.php');
  exit(); 
}



if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $Numéro = $_POST['Numéro'];
    $Numéro = filter_var($Numéro, FILTER_SANITIZE_STRING);
    
    
   
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/' . $image;

  move_uploaded_file($image_tmp_name, $image_folder);

   $check_std_id = $conn->prepare("SELECT * FROM admine WHERE email = ?");
   $check_std_id->execute([$email]);

   if ($check_std_id->rowCount() > 0) {
       $message[] = "   E-mail en double  ";
   } else {

   $insert_admin_id = $conn->prepare("INSERT INTO `admine`(name, email, password, Numéro, image) VALUES(?,?,?,?,?)");
   $insert_admin_id->execute([$name, $email, $pass, $Numéro, $image]);
   $select_admin_id = $conn->prepare("SELECT * FROM `admine` WHERE email = ? AND password = ?");
   $select_admin_id->execute([$email, $pass]);
   $row = $select_admin_id->fetch(PDO::FETCH_ASSOC);
   if($select_admin_id->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');

 }
   }

  }

?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Sign </title>
    <style>
        *{
          margin: 0;
          padding: 0;
        }
        body {
          width: 100%;
          height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
        }
        .container {
          width: 80%;
          max-width: 700px;
          height: 420px;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
        }

        .sign-up-form-none {
            display: none;
        }
        .sign-up-form {
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          position: absolute;
          direction: ltr;
          background: white;
          width: 50%;
          height: 100%;
          animation: aGauche2 .5s ease forwards;
          transition: 1.8s ease-in-out;
        }
        .sign-animation{
          animation:  aGauche3 .5s ease forwards ;
        }
        @keyframes aGauche2 {
          0% { transform: translateY(100%); opacity: 0;}
          100% { transform: translateY(0%); opacity: 1; }
        }
        @keyframes aGauche3 {
          0% { transform: translateY(0%); opacity: 1;}
          100% { transform: translateY(100%); opacity: 0; }
        }
        .forms-container {
            position: relative;
            display: flex;
            direction: rtl;
            width: 100%;
            height: 100%;
            box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
            overflow: hidden;
            border-radius: 5px;
        }
        .logoBackground {
            height: 100%;
            width: 50%;
        }
        .logoBackground-animation {
            height: 100%;
            width: 50%;
            animation: aGauche .5s ease forwards;
            transition: 1.8s ease-in-out;
        }
        .logoBackground-animation2 {
            height: 100%;
            width: 50%;
            animation: adroit .5s ease forwards;
            transition: 1.8s ease-in-out;
        }
        .login{
            width: 100%;
            height: 100%;
        }

        .signin-signup {
            width: 50%;
            height: 100%;
            background: white;
            border-right: 1px solid #eee;
        }
        .signin-signup-animation {
            width: 50%;
            height: 100%;
            background: white;
            border-right: 1px solid #eee;            
            animation: aGaucheD .5s ease forwards;
            transition: 1.8s ease-in-out;
        }
        .signin-signup-animation2 {
            width: 50%;
            height: 100%;
            background: white;
            border-right: 1px solid #eee;            
            animation: up .5s ease forwards;
            transition: 1.8s ease-in-out;
        }
          .con {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        @keyframes up {
          0% { transform: translateX(70%); opacity: 0;}
          100% { transform: translateX(0%); opacity: 1; }
        }
        @keyframes aGaucheD {
          0% { transform: translateX(0%); opacity: 1;}
          100% { transform: translateX(-100%); opacity: 0; }
        }
        @keyframes aGauche {
          0% { transform: translateX(0%);}
          100% { transform: translateX(-100%); }
        }
        @keyframes adroit {
          0% { transform: translateX(-100%); }
          100% { transform: translateX(0%);}
          
        }
        
        
        input[type="email"] ,  input[type="password"] , input[type="number"] , input[type="text"]   {
          border: 1px solid #ccc;
          border-radius: 5px;
          width: 250px;
          height: 70%;
          outline: none;
          padding-left: 5px;
        }

        .input-field {
          width: 300px;
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 10px;
          height: 52px;
          direction: ltr;
        }

        input.btn.solid {
          width: 125px;
          height: 38px;
          font-size: 13px;
          background: linear-gradient(45deg, #0075ff, #47c2ff);          
          border: none;
          border-radius: 7px;
          color: white;
          margin-right: 26px;
          margin-top: 10px;
        }

        .content {
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 10px;
          margin-top: 15px;
          direction: ltr;
        }

        i.fas.fa-envelope , i.fas.fa-lock , i.fas.fa-user , i.fa-solid.fa-phone {
            font-size: 20px;
        }

        #sign-up-btn {
          width: 123px;
          height: 31px;
          font-size: 11px;
          background: #26aef1;
          border: none;
          border-radius: 7px;
          color: white;
          font-weight: bold;
          display: flex;
          align-items: center;
          justify-content: center;
        }
        h3 {
            font-size: 14px;
        }

        h2.title {
            margin-bottom: 35px;
            color: #1188ff;
        }
        h2.titre {
            margin-bottom: 15px;
            color: #1188ff;
        }
        input.btn {
          width: 182px;
          height: 35px;
          font-size: 11px;
          background: linear-gradient(45deg, #0075ff, #47c2ff);
          border: none;
          border-radius: 7px;
          color: white;
        }
        #sign {
          width: 123px;
          height: 31px;
          font-size: 12px;
          background: #26aef1;
          border: none;
          border-radius: 7px;
          color: white;
          font-weight: bold;
          display: flex;
          align-items: center;
          justify-content: center;
        }
        .panel.right-panel {
            height: 45px;
        }

        @media (max-width: 700px) {
          .logoBackground{
            display: none;
          }
          .logoBackground-animation{
            display: none;
          }
          .logoBackground-animation2{
            display: none;
          }
          .signin-signup-animation{
            display: none;
          }
          .signin-signup{
            width: 100%;
          }
          .signin-signup-animation2{
            width: 100%;
          }
          .sign-up-form{
            width: 100%;
            gap: 10px;
          }
          .container{
            width: 100%;
            height: 100%;
          }
          form.con {
              gap: 10px;
          }


        }





        .uilo {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 114px;
    gap: 36px;
    color: #a7a7a7;
    font-size: large;
  }
</style>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">

        <div id="loginImg" class="logoBackground">
          <img class="login"  src="login.jpg" alt="">
        </div>

        <form action="" method="post" enctype="multipart/form-data" id="registration" class="sign-up-form-none">
            <h2 class="titre">Registre</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="name" required placeholder="le nom complet" />
            </div>
            <div class="input-field">
            <i class="fa-solid fa-phone"></i>
              <input type="number" name="Numéro" required placeholder="Numéro de téléphone" />
            </div>

            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" required placeholder="Email" />
            </div>
            
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="pass" required placeholder="mot de passe" />
            </div>

            <div class="input-field" style="display: flex; align-items: center;">
              <label for="image-input" class="file-upload">
                <div class="uilo">
                  <i class="fa-solid fa-camera"></i> 
                  <p id="image-label">Image</p>
                </div>
                <input id="image-input" type="file" name="image" required class="box" accept="image/*" style="display: none;" onchange="displaySelectedImage(event)">
              </label>
            </div>


            <input type="submit" class="btn" name="submit" value="Créer un nouveau compte" />
            
           
            
            <div class="panel right-panel">
            <div class="content">
              <h3>Êtes-vous déjà avec nous ?</h3>
              <div onclick="retourner();" class="btn transparent" id="sign">
                se connecter ici
              </div>
            </div>
            <img src="img/register.svg" class="image" alt="" />
          </div>
          </form>



        <div id="connecter" class="signin-signup">

          <?php
         


            

          if(isset($_POST['submuit'])){

            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_STRING);
            $pass = sha1($_POST['pass']);
            $pass = filter_var($pass, FILTER_SANITIZE_STRING);
         
            $select_admin = $conn->prepare("SELECT * FROM `admine` WHERE email = ? AND password = ?");
            $select_admin->execute([$email, $pass]);
            
            if($select_admin->rowCount() > 0){
               $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
               $_SESSION['admin_id'] = $fetch_admin_id['id'];
               header('location:dashboard.php');
            }else{
               $message[] = 'incorrect username or password!';
            }
         
         }
         
         ?>

          <form action="" method="post" class="con">
            <h2 class="title">Se connecter</h2>
            <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="pass" placeholder="mot de passe" required/>
            </div>
            <input type="submit" name="submuit" value="Se connecter" class="btn solid" />
           


              <div class="panel left-panel">
            <div class="content">
              <h3>nouveaux avec notre ?</h3>
              <div class="btn transparent" onclick="alleAInsc();" id="sign-up-btn">
              Créer un nouveau
              </div>
            </div>
            <img src="img/log.svg" class="image" alt="" />
          </div>
          </form>



        </div>
      </div>

    </div>
    <script>

    function alleAInsc() {
      let connecter = document.getElementById('connecter');
      let loginImg = document.getElementById('loginImg');
      let registration = document.getElementById('registration');
      connecter.classList.replace( "signin-signup", "signin-signup-animation" );
      loginImg.classList.replace( "logoBackground", "logoBackground-animation" );
      registration.classList.replace( "sign-up-form-none", "sign-up-form" );
    }
    function retourner() {
      let connecter = document.getElementById('connecter');
      let loginImg = document.getElementById('loginImg');
      let registration = document.getElementById('registration');
      registration.classList.replace("sign-up-form" , "sign-animation");
      registration.classList.replace( "sign-animation", "sign-up-form-none" );
      loginImg.classList.replace("logoBackground-animation" , "logoBackground-animation2");
      setTimeout(function(){
        loginImg.classList.replace("logoBackground-animation2" , "logoBackground");
      }, 500);
      connecter.classList.replace( "signin-signup-animation", "signin-signup-animation2" );
      setTimeout(function(){
        connecter.classList.replace( "signin-signup-animation2", "signin-signup" );
      }, 500);
    }

    </script>











    <script src="app.js"></script>
    <script>
  function displaySelectedImage(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const imageLabel = document.getElementById('image-label');
        imageLabel.textContent = '';
        const img = document.createElement('img');
        img.src = e.target.result;
        img.style.width = '100%';
        img.style.height = '48px';
        imageLabel.appendChild(img);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
  </body>
</html>







