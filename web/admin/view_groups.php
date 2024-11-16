<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($_SESSION['admin_id'])){
  header('location:login_admin.php');
}



$get_id = $_GET['Enseignants_id'];



 if(isset($_POST['delete_groups'])){
  $delete_groups_id = $_POST['group_id'];
  $delete_groups_id = filter_var($delete_groups_id, FILTER_SANITIZE_STRING);
  $delete_groups = $conn->prepare("DELETE FROM `groups` WHERE id = ?");
  $delete_groups->execute([$delete_groups_id]);
  $message[] = 'deleted successfully!';
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
  button.inline-delete-btn {
    background: 000;
    border: none;
}
</style>

  </head>
  <body>
    <div id="overlay" class="overlay"></div>
    <div id="left" class="left">
      <div class="titi">
      <h2>Administration</h2>
      </div>
      <ul>

      <a href="dashboard.php" style="text-decoration: none;">
        <li class="tab">
          <svg
            class="w-5 h-5"
            aria-hidden="true"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
            ></path>
          </svg>
          <h3>Tableau de bord</h3>
        
        </li>

        </a>


        <a href="list_formation.php" style="text-decoration: none;">

        <li class="tab">
          <svg
            class="w-5 h-5"
            aria-hidden="true"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
          </svg>
          <h3>formation</h3>
            </li>
        </a>
        <a href="list_étudiant.php" style="text-decoration: none;">
        <li class="tab">
          <svg
            class="w-5 h-5"
            aria-hidden="true"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
          </svg>
          <h3>Liste de vos étudiants</h3>
        </li>
        </a>

        <a href="list_Enseignants.php" style="text-decoration: none;">
        <li class="tab">
          <svg
            class="w-5 h-5"
            aria-hidden="true"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
            ></path>
          </svg>
          <h3>list Enseignants</h3>
        </li>
        </a>


      </ul>
    </div>
    <div class="right">
      <header>
        <div class="contain">
          <div id="menu" class="menu-bar">
            <svg
              class="w-6 h-6"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </div>
          <div class="con-search">
            <form action="search.php" method="POST" class="search-form">
              <input type="search" name="search_box" placeholder="    recherche..." />
              <button type="submit" class="fas fa-search" name="search_btn"></button>
            </form>

          </div>
          <ul class="options">
            <li class="light-mode">
              
              <svg style="display: none;" id="sun" class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
              </svg>
            </li>
            <li class="profile">
              <a href="page.php" class="img-a">
                <?php
            $select_profile = $conn->prepare("SELECT * FROM `admine` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
              ?>
          
              <?php
                        if($fetch_profile['image'] != ''){  
                    ?>
                    
                    <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" style="width:34px; height:34px; border-radius:50%;" alt="" aria-hidden="true">
                    <?php 
                }else {
            ?>
                          
                    <img src="../img/chico.jpg" alt="" style="width:34px; height:34px; border-radius:50%;">
                    
            <?php 
                
            }
            ?>


            <?php 
                
            }
            ?>
              </a>
            </li>
          </ul>
        </div>
      </header>



      
      <div class="main">
        <h2 class="ti">Tableau de formation</h2>
        <div class="grid-container">




        
                        
        <div class="table-cont">
          <div class="div-table">
          <table>
            <thead>
              <tr>
              <th>groups</th>
                 <th>Date de création</th>
                 <th>supprimer</th>

                 </tr>

            </thead>

            <?php
                  $select_groups = $conn->prepare("SELECT * FROM `groups` WHERE Enseignants_id = ? ORDER BY id DESC");
                  $select_groups->execute([$get_id]);
                  if($select_groups->rowCount() > 0){
                    while($fetch_groups = $select_groups->fetch(PDO::FETCH_ASSOC)){ 
                        $groop_id = $fetch_groups['id'];

                  ?>
            <tbody>
              <tr>

                <td class="tden">
                <?php
                  $select_formation = $conn->prepare("SELECT * FROM `formation` WHERE Enseignants_id = ?");
                  $select_formation->execute([$get_id]);
                  if($select_formation->rowCount() > 0){
                    $fetch_formation = $select_formation->fetch(PDO::FETCH_ASSOC)

                  ?>
                  <p><?= $fetch_formation['title']; ?></p>

                  <?php
                      
                  }
                  ?>

                </td>
                <td>
                            <?php
                                $mois = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
                                $date_fr = date("j ", strtotime($fetch_groups['date'])) . $mois[date("n", strtotime($fetch_groups['date'])) - 1] . date(" Y", strtotime($fetch_groups['date']));
                                echo $date_fr;
                                ?>                                
                        </td>

<td>
                            <form action="" method="POST">
                            <input type="hidden" name="group_id" value="<?= $fetch_groups['id']; ?>">
                            <button type="submit" class="inline-delete-btn" name="groups_id" onclick="return confirm(' Voulez-vous vraiment supprimer ?');"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    



                              </tr>
                            </tbody>
                            <?php
                      }
                  }
                  ?>
                          </table>
                          
                        </div>
                        </div>











                        




</div>
</div>





<script src="../js/script.js"></script>



  </body>
</html>
