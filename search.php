

<?php

include './components/connect.php';

session_start();


if(isset($_SESSION['étudiant_id'])){
    $étudiant_id = $_SESSION['étudiant_id'];
 }else{
    $étudiant_id = '';
 };

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>search</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="stylesheet" href="../css/Enseignants.css">
<style>

  *{
    margin: 0;
    padding: 0;
  }
body {
    display: flex;
    height: 100vh;
    flex-direction: column;
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
      justify-content: center;
      width: 100%;
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


  .con-search {
    padding: 10px 0px;
      display: flex;
      align-items: center;
      justify-content: end;
      width: 95%;
      min-width: 200px;
      height: 33px;
      border-radius: 5px;
    }
  form.search-form {
    display: flex;
    width: 100%;
    height: 100%;
    background: #f4f5f7;
    border-radius: 50px;
}
  input[type="search"] {
    width: 100%;
    min-width: 174px;
    outline: none;
    border-radius: 5px;
    border: none;
    background: unset;
    font-size: 16px;
    padding-left: 10px;
  }
  ul.options {
    width: 100px;
    display: flex;
  }
  li.light-mode {
    width: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 5px;
    color: #7e3af2;
    cursor: pointer;
  }

  .kiwi{
    height: 50px;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
  }
  button.fas.fa-search {
    width: 50px;
    border: none;
    background: unset;
}
@media (max-width: 480px) {
  img {
    width: 173px;
    height: 168px;
  }
}
img {
    width: 100%;
    height: 168px;
}
</style>

  </head>
  <body>

  <section class="kiwi">
  <div class="con-search">
            <form action="search.php" method="POST" class="search-form">
              <input type="search" name="search_box" placeholder="    recherche..." />
              <button type="submit" class="fas fa-search" name="search_btn"></button>
            </form>

          </div>
  </section>



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
         $select_Enseignants = $conn->prepare("SELECT * FROM `Enseignants` WHERE name LIKE '%{$search_box}%'");
         $select_Enseignants->execute();
         if($select_Enseignants->rowCount() > 0){
            while($fetch_Enseignants = $select_Enseignants->fetch(PDO::FETCH_ASSOC)){
               
               
      ?>
      <form class="box" method="post">
        
         <div class="post-admin">

  <img src="./uploaded_img/<?= $fetch_Enseignants['image'];  ?>" alt="" >
                            
                            <div>
             
            </div>
         </div>
         
         <div class="post-title"><?= $fetch_Enseignants['name']; ?></div>

         <div class="post-title"><?= $fetch_Enseignants['Numéro']; ?></div>
         <div class="post-content content-150"><?= $fetch_Enseignants['email']; ?></div>
         
      
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