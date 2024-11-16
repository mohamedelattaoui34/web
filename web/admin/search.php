<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($_SESSION['admin_id'])){
  header('location:login_admin.php');
}


?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Enseignants</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="stylesheet" href="../css/Enseignants.css">
<style>


body {
    display: flex;
    height: 100vh;
    overflow: hidden;
    flex-direction: column;
}

.posts-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 20px;
}

.box-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}


.li {
    margin: 10px 0px;
}






  button.inline-delete-btn {
    background: 000;
    border: none;
}



.posts-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  padding: 20px;
}

.box {
  width: 300px;
  height: 310px;
  background-color: #fff;
  border-radius: 10px;
  margin-bottom: 20px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.box video {
  width: 100%;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

.post-admin {
  padding: 10px;
  display: flex;
  align-items: center;
}

.post-admin a {
  font-weight: bold;
  color: #333;
  text-decoration: none;
  margin-right: 10px;
}

.post-title {
  font-size: 18px;
  font-weight: bold;
  color: #333;
  padding: 10px;
}

.post-content {
  color: #666;
  padding: 10px;
}

.empty {
  text-align: center;
  padding: 20px;
  color: #666;
}

.tab .w-5 {
  width: 20px;
}

.tab .h-5 {
  height: 20px;
}

button.inline-delete-btn {
  background-color: #f44336;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button.inline-delete-btn:hover {
  background-color: #d32f2f;
}
h2.tite {
    text-align: center;
}


@media (max-width: 960px) {
  .box-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
  }
  .box{
    width: unset;
  }
}
@media (max-width: 480px) {
  .box-container{
        gap: 18px;
        display: flex;
        flex-direction: column;
  }
}

</style>

  </head>
  <body>

  <div class="li">
    <h2 class="tite">
    résultats de votre recherche
    </h2>
  </div>

<?php
   if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
?>
<section class="posts-container">

   <div class="box-container">

      <?php
         $search_box = $_POST['search_box'];
         $select_formation = $conn->prepare("SELECT * FROM `formation` WHERE title LIKE '%{$search_box}%' OR liés LIKE '%{$search_box}%' OR public LIKE '%{$search_box}%' AND status = ?");
         $select_formation->execute(['active']);
         if($select_formation->rowCount() > 0){
            while($fetch_formation = $select_formation->fetch(PDO::FETCH_ASSOC)){
               
               
      ?>
      <form class="box" method="post">
        
         <div class="post-admin">

         <video controls autoplay class="leconfimg">
            <source src="../uploaded_videos/<?= $fetch_formation['video']; ?>" type="video/mp4">
                            </video>
                            
                            <div>
             
            </div>
         </div>
         
         <div class="post-title"><?= $fetch_formation['title']; ?></div>

         <div class="post-title"><?= $fetch_formation['liés']; ?></div>
         <div class="post-content content-150"><?= $fetch_formation['public']; ?></div>
         
      
      </form>
      <?php
         }
      }else{
      }
      ?>
   </div>

</section>

<?php
   }else{
    echo '<section><p class="empty">cherche quelque chose !!</p></section>';
  }
?>
   

<script src="js/script.js"></script>

</body>
</html>