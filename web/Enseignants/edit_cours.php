<?php

include '../components/connect.php';

session_start();

$Enseignants_id = $_SESSION['Enseignants_id'];

if(!isset($_SESSION['Enseignants_id'])){
  header('location:login_Enseignant.php');
}

$get_id = $_GET['partie_id'];

if(isset($_POST['edit'])){


    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);

    

    
    $insert_user = $conn->prepare("UPDATE `partie` SET status = ? WHERE id = ?");
    $insert_user->execute([$status, $get_id]);


    

  
}


?>



<!DOCTYPE html>
    <html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title> edit </title>
        <link rel="stylesheet" href="./css/stylee.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
    
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f0f0f0;
}

.container {
  max-width: 500px;
  margin: 50px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.container h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

form {
  text-align: center;
}

form p {
  margin-bottom: 10px;
  font-weight: bold;
  color: #555;
}

form select {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

form .btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

form .btn:hover {
  background-color: #0056b3;
}

span.required {
  color: #ff0000;
  font-size: 18px;
}

a.back-link {
  display: block;
  margin-top: 20px;
  text-align: center;
  color: #007bff;
  text-decoration: none;
}

a.back-link i {
  margin-right: 3px;
}

a.back-link:hover {
  text-decoration: underline;
}

</style>
    </head>
    <body>

    <a href="index.php" class="o"><i class="fa-solid fa-arrow-right" style="color:white; margin-right:3px; direction: rtl; font-size: 25px;"></i></a>

<?php
$select_profile = $conn->prepare("SELECT * FROM `partie` WHERE id = ?");
$select_profile->execute([$get_id]);
if ($select_profile->rowCount() > 0) {
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>
    <form action="" method="post" enctype="multipart/form-data">

    <p> status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="<?= $fetch_profile['status']; ?>" selected><?= $fetch_profile['status']; ?></option>
         <option value="active">active</option>
         <option value="deactive">désactive</option>
      </select>
      <input type="submit" value="save status" name="edit" class="btn">

    </form>
<?php } ?>










    </body>
    </html>
