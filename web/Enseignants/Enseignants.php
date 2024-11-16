<?php

include '../components/connect.php';

session_start();

$Enseignants_id = $_SESSION['Enseignants_id'];

if(!isset($_SESSION['Enseignants_id'])){
  header('location:login_Enseignant.php');
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
        @media (min-width: 1120px) {
    .left{
      display: flex;
      justify-content: start;
      gap: 84px;
      width: 17rem;
      flex-direction: column;
    }
    .container {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      padding: 0 50px;
    }
    .tabs {
      height: 50px;
      text-align: center;
      line-height: 100px;
      box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05);
      padding: 1rem;
      border-radius: 0.5rem;
      background: white;
    }
    .con-search {
      margin-right: 250px;
      width: 580px;
    }
    header {
      padding: 10px 0px;
    }
    th {
      padding: 0.75rem 2rem;
    }
  }
  .con-search {
    display: flex;
    align-items: center;
    justify-content: end;
    background: #f4f5f7;
    width: 552px;
    min-width: 200px;
    height: 36px;
    border-radius: 5px;
  }
  input[type="search"] {
    width: 100%;
    min-width: 174px;
    height: 32px;
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
    </style>

  </head>
  <body>
    <div id="overlay" class="overlay"></div>
    <div id="left" class="left">
      <div class="titi">
        <h2>l'enseignant</h2>
      </div>
      <ul>

      <a href="Enseignants.php" style="text-decoration: none;">
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


        <a href="all_gr.php" style="text-decoration: none;">

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
          <h3>Groupes</h3>
            </li>
        </a>
        <a href="étudiant.php" style="text-decoration: none;">
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
            <path
              d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
            ></path>
          </svg>
          <h3>Cours de formation</h3>
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
              <a href="profile.php" class="img-a">
                <?php
            $select_profile = $conn->prepare("SELECT * FROM `Enseignants` WHERE id = ?");
            $select_profile->execute([$Enseignants_id]);
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
        <h2 class="ti">Tableau de bord</h2>
        <div class="grid-container">
          <div class="container">


            <div class="tabs">
              <div class="inside-right" id="orange">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                  ></path>
                </svg>
              </div>
              <div class="inside-left"> 


                <a href="all_gr.php"  style="text-decoration: none;">
                <div class="inside-top">
                <p>Vos groupes</p>
                            </div>
                <div class="inside-bottom">
                <?php
                    $select_student = $conn->prepare("SELECT * FROM `groups` WHERE Enseignants_id = ?");
                    $select_student->execute([$Enseignants_id]);
                    $total_groups = $select_student->rowCount();
                  ?>
                  <p class="p-num"><?= $total_groups; ?></p>
                </div>
              </div>
            </a>
            </div>



            
            <div class="tabs">
              <div
                class="inside-right"
                id="blue"
                style="color: rgb(63 131 248); background: rgb(225 239 254)"
              >
          
                <i class="fa-solid fa-plus"
                    style="
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.2rem;
                  "
                ></i>
              </div>
              <div class="inside-left">

                <a href="ajoute.php" style="text-decoration: none;">
                <div class="inside-top">
                  <p> ajoute formation</p>

                </div>
                <div class="inside-bottom">
                <?php
                    $select_groups = $conn->prepare("SELECT * FROM `groups` WHERE Enseignants_id = ?");
                    $select_groups->execute([$Enseignants_id]);
                    $total_groups = $select_groups->rowCount();
                  ?>
                  <p class="p-num"><?= $total_groups; ?></p>
                </div>
              </div>     
              </a>
            </div>


            <div class="tabs">
              <div
                class="inside-right"
                id="blue"
                style="color: rgb(15 177 96);background: rgb(225 254 241);"
              >
              <i class="fa-solid fa-user-graduate"
              style="
                    display: flex;
                    align-items: center;
                    justify-content: center;
                  "
              ></i>
              </div>
              <div class="inside-left">

                <a href="étudiant.php" style="text-decoration: none;">
                <div class="inside-top">
                  <p>étudiant</p>
                </div>
                <div class="inside-bottom">
                <?php
                    $select_groups = $conn->prepare("SELECT * FROM `groups` WHERE Enseignants_id = ?");
                    $select_groups->execute([$Enseignants_id]);
                    $total_groups = $select_groups->rowCount();
                  ?>
                  <p class="p-num"><?= $total_groups; ?></p>
                </div>
              </div>     
              </a>
            </div>



            <div class="tabs">
              <div
                class="inside-right"
                id="blue"
                style="color: rgb(63 131 248); background: rgb(225 239 254)"
              >
              <i
                  class="fa-solid fa-clipboard-list"
                  style="
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.3rem;
                  "
                ></i>
              </div>
              <div class="inside-left">     
              <a href="list_formation.php" style="text-decoration: none;">
                <div class="inside-top">
                  <p>Cours de formation</p>
                </div>
                <div class="inside-bottom">
                <?php
                    $select_time = $conn->prepare("SELECT * FROM `formation` WHERE Enseignants_id = ?");
                    $select_time->execute([$Enseignants_id]);
                    $total_time = $select_time->rowCount();
                  ?>
                  <p class="p-num"><?= $total_time; ?></p>
                </div>
              </div>
            </a>
            </div>
          
          </div>
        </div>
        <div class="table-cont">
          <div class="div-table">
          <table>
            <thead>
              <tr>
              <th>étudient</th>
                 <th>Numéro de téléphone</th>
                 <th>Statut</th>
                 <th>la date d'adhésion</th>
                 </tr>

            </thead>

            <?php
                  $select_Enseignants_id = $conn->prepare("SELECT * FROM `groups` WHERE Enseignants_id = ? ORDER BY id DESC LIMIT 10");
                  $select_Enseignants_id->execute([$Enseignants_id]);
                  if($select_Enseignants_id->rowCount() > 0){
                    while($fetch_Enseignants_id = $select_Enseignants_id->fetch(PDO::FETCH_ASSOC)){ 

                      $étudiant_id = $fetch_Enseignants_id['étudiant_id'];

                                $select_étudiant = $conn->prepare("SELECT * FROM `étudiant` WHERE id = ?");
                                $select_étudiant->execute([$étudiant_id]);
                                    if($select_étudiant->rowCount() > 0){
                                    $fetch_étudiant = $select_étudiant->fetch(PDO::FETCH_ASSOC);

                  ?>
            <tbody>
              <tr>

                <td class="tden">
                  <img src="../uploaded_img/<?= $fetch_étudiant['image']; ?>" alt="" class="pro_image">
                <?= $fetch_étudiant['name']; ?>
                </td>

                <td>                
                <?= $fetch_étudiant['Numéro']; ?>
                </td>

                <td>

                <button class="loop" style="<?php if($fetch_étudiant['Numéro'] > 0){echo 'background:green; padding: 5px 5px; border-radius: 50%; border: none;'; } ?>"></button>

                </td>


                                <td>
                                <?php
                        $mois = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
                        $date_fr = date("j ", strtotime($fetch_étudiant['date'])) . $mois[date("n", strtotime($fetch_étudiant['date'])) - 1] . date(" Y", strtotime($fetch_étudiant['date']));
                        echo $date_fr;
                        ?>                                </td>


                              </tr>
                            </tbody>
                            <?php
                      }}
                  }else{
                      echo '<p class="empty"></p>';
                  }
                  ?>
                          </table>
                          
                        </div>
                        </div>

</div>
</div>



<script src="../js/script.js"></script>



<script>
      let menu = document.querySelector("#menu");
      let overlay = document.querySelector("#overlay");
      let left = document.querySelector("#left");

      menu.addEventListener("click", function () {
        let leftDisplayStyle = window.getComputedStyle(left).getPropertyValue("display");
        if (leftDisplayStyle === "none") {
          overlay.style.display = "block";
          left.style.display = "block";
        } else {
          overlay.style.display = "none";
          left.style.display = "none";
        }
      });
        overlay.addEventListener("click", function () {
        overlay.style.display = "none";
        left.style.display = "none";
      });
      



</script>



  </body>
</html>
