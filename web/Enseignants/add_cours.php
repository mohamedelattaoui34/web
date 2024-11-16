

<?php

include '../components/connect.php';

session_start();

$Enseignants_id = $_SESSION['Enseignants_id'];

if(!isset($_SESSION['Enseignants_id'])){
  header('location:login_Enseignant.php');
}

$get_id = $_GET['cours_id'];

    if (isset($_POST['publish'])) {
        $content = $_POST['content'];
        $content = filter_var($content, FILTER_SANITIZE_STRING);
      
        if(isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
          $pdf = $_FILES['pdf']['name'];
          $pdf_tmp_name = $_FILES['pdf']['tmp_name'];
          $pdf_folder = '../uploaded_pdf/' . $pdf;
          if(move_uploaded_file($pdf_tmp_name, $pdf_folder)) {
            $insert_post = $conn->prepare("INSERT INTO `partie` (Enseignants_id, pdf, status, content, cours_id) VALUES (?,?,?,?,?)");
            $insert_post->execute([$Enseignants_id, $pdf, $_POST['status'], $content, $get_id]);
          } else {
            echo "Error uploading file.";
          }
        } else {
          echo "No file uploaded.";
        }
      }
      
      if(isset($_POST['delete_partie'])){
        $delete_partie_id = $_POST['partie_id'];
        $delete_partie_id = filter_var($delete_partie_id, FILTER_SANITIZE_STRING);
        $delete_partie = $conn->prepare("DELETE FROM `partie` WHERE id = ?");
        $delete_partie->execute([$delete_partie_id]);
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
                .Areet {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: unset;
                    z-index: 9;
                    box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
                    border-radius: 3px;
                }

                .cin{
                    width: 150px;
                    height: 150px;
                    position: absolute;
                    top: 171px;
                    left: 250px;
                    padding: 10px;
                    background: white;
                    box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
                    z-index: 10;
                }

                .Areete {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: unset;
                    z-index: 9;
                    box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
                    border-radius: 3px;
                }
                .choisir {
                    width: 300px;
                    height: 200px;
                    position: absolute;
                    top: 171px;
                    left: 250px;
                    padding: 10px;
                    background: white;
                    box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
                    z-index: 10;
                }
                @media (max-width: 480px) {
                    .choisir{
                            top: 171px;
                            left: 14px;
                    }
                }

                    
                    
                    .choisir form {
                        background-color: #fefefe;
                        margin: 10% auto; 
                        padding: 20px;
                        border: 1px solid #888;
                        width: 80%; 
                        max-width: 500px;
                        border-radius: 8px;
                    }
                    
                    .choisir textarea {
                        width: 100%;
                        margin-bottom: 10px;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        box-sizing: border-box;
                    }
                    
                    .file-upload {
                        position: relative;
                        overflow: hidden;
                        display: inline-block;
                    }
                    
                    .file-upload input[type="file"] {
                        position: absolute;
                        top: 0;
                        right: 0;
                        width: 100%;
                        height: 100%;
                        font-size: 100px;
                        cursor: pointer;
                        opacity: 0;
                    }
                    
                    .choisir select {
                        width: 100%;
                        padding: 10px;
                        margin-bottom: 10px;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        box-sizing: border-box;
                    }
                    
                    .flex-btn {
                        display: flex;
                        justify-content: flex-end;
                    }
                    
                    .choisir input[type="submit"] {
                        padding: 10px 20px;
                        background-color: #3986d1;
                        color: white;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                    }
                    
                    .close {
                        color: #aaa;
                        float: right;
                        font-size: 28px;
                        font-weight: bold;
                    }
                    
                    .close:hover,
                    .close:focus {
                        color: black;
                        text-decoration: none;
                        cursor: pointer;
                    }
                    i.fa-solid.fa-plus {
                        font-size: 1.7rem;
                        color: #3986d1;
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
            <input type="search" placeholder="    recherche..." />
            <svg
              class="w-4 h-4"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                fill-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                clip-rule="evenodd"
              ></path>
            </svg>
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





                        <p>ajouter un lecon</p><i onclick="ouvrire();" class="fa-solid fa-plus"></i>

<div onclick="fermer();" id="piko" class="Areete" style="display: none;">
    <div class="choisir" onclick="event.stopPropagation()">
        <form action="" method="post" enctype="multipart/form-data">
            <textarea name="title" class="box" required maxlength="10000" placeholder="Écrire un titre..."></textarea>
            
            <textarea name="content" class="box" required maxlength="10000" placeholder="Écrire un contenu..."></textarea>

          <p> PDF</p>
          <label for="pdf-input" class="file-upload">
            <i class="fa-solid fa-file"></i>
            <input id="pdf-input" type="file" name="pdf" class="box" accept=".pdf" style="display: none;">
          </label>


            <p> statut <span>*</span></p>
          <select name="status" class="box" required>
            <option selected></option>
            <option value="active">actif</option>
            <option value="deactive">inactif</option>
          </select>
            <div class="flex-btn">
            <input type="submit" value=" Ajouter" name="publish" class="btn">
            </div>
        </form>
    </div>
</div>




                          
        <div class="table-cont">
          <div class="div-table">
          <table>
            <thead>
              <tr>
              <th>Titre du cours</th>
                 <th> État du cours</th>
                <th> ajoute une chapitre</th>
                 <th>Supprimer les cours</th>

                 </tr>

            </thead>

            <?php
         $select_partie = $conn->prepare("SELECT * FROM `partie` WHERE cours_id = ? ORDER BY id DESC");
         $select_partie->execute([$get_id]);
         if($select_partie->rowCount() > 0){
            while($fetch_partie = $select_partie->fetch(PDO::FETCH_ASSOC)){
               $partie_id = $fetch_partie['id'];
               $cours_id = $fetch_partie['cours_id'];
               ?>

            
            <tbody>
              <tr>

                <td>

                  <p><?= $fetch_partie['content']; ?></p>


                </td>
                
                <td>
                <a href="edit_cours.php?partie_id=<?= $partie_id; ?>"><?= $fetch_partie['status']; ?> <i class="fa-solid fa-pen-to-square "></i></a>


            </td>
            
            <td>
                <a href="add_partie.php?cours_id=<?= $cours_id; ?>&partie_id=<?= $partie_id; ?>"><i class="fa-solid fa-plus" style="font-size:16px"></i></a>


            </td>

              

                <td>
                            <form action="" method="POST">
                            <input type="hidden" name="partie_id" value="<?= $fetch_partie['id']; ?>">
                            <button type="submit" style="border: none;background: 000;" name="delete_partie" onclick="return confirm('Voulez-vous supprimer le groupe');"><i class="fa-solid fa-trash"></i></button>
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




<script>
                    function ouvrire() {
                        let bido = document.querySelector(".Areete");
                        
                            bido.style.display = "block";
                    }
                    function fermer() {
                        let aret = document.getElementById('piko');
                        aret.style.display = "none";
                    }

                </script>

             


  </body>
</html>