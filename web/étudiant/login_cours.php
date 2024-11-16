
<?php

include '../components/connect.php';

session_start();

$get_id = $_GET['cours_id'];

?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>mot de passe </title>
    <style>
 

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f0f0f0;
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.forms-container {
  width: 100%;
  max-width: 400px;
  padding: 20px;
}

.signin-signup {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 40px;
}

.title {
  text-align: center;
  margin-bottom: 30px;
  color: #333;
}

.input-field {
  position: relative;
  margin-bottom: 30px;
}

.input-field input {
  width: 100%;
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  outline: none;
  font-size: 16px;
}

.input-field input:focus {
  border-color: #007bff;
}

.input-field i {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  left: 10px;
  color: #999;
}

.btn {
  width: 100%;
  padding: 15px;
  border: none;
  border-radius: 5px;
  background-color: #007bff;
  color: #fff;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn:hover {
  background-color: #0056b3;
}

.error-message {
  text-align: center;
  color: #ff0000;
  margin-bottom: 20px;
}

@media screen and (max-width: 768px) {
  .forms-container {
    padding: 10px;
  }
  
  .signin-signup {
    padding: 20px;
  }
}

@media screen and (max-width: 480px) {
  .input-field input {
    font-size: 14px;
  }
  
  .btn {
    font-size: 16px;
  }
}

</style>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">

          <?php
         

          
            

          if(isset($_POST['submuit'])){

            $code = $_POST['code'];
            $code = filter_var($code, FILTER_SANITIZE_STRING);


            $select_Enseignants = $conn->prepare("SELECT * FROM `cours` WHERE code = ? AND cours_id = ?");
            $select_Enseignants->execute([$code, $get_id]);
            
            if($select_Enseignants->rowCount() > 0){
               $fetch_Enseignants_id = $select_Enseignants->fetch(PDO::FETCH_ASSOC);
               $_SESSION['cours_id'] = $fetch_Enseignants_id['cours_id'];
               header('location:cours.php');
            }else{
               $message[] = 'mot de passe!';
            }
         
         }
         
         ?>

          <form action="" method="post" class="sign-in-form">
            <h2 class="title"> mot de passe</h2>

            <div class="input-field">
              <i class="fas fa-lock"></i>

              <input type="password" name="code" placeholder="mot de passe" required/>
            </div>
            <input type="submit" name="submuit" value="Entrée" class="btn solid" />
           
           
          </form>











        </div>
      </div>


    <script src="app.js"></script>

  </body>
</html>







