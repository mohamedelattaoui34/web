<?php

include '../components/connect.php';

session_start();

$cours_id = $_SESSION['cours_id'];

if(!isset($_SESSION['cours_id'])){
  header('location:login_cours.php');
}



$get_id = $_GET['partie_id'];
$cours_id = $_GET['cours_id']; 



?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>cours</title>
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
                i.far.fa-file-pdf, i.fa-solid.fa-down-long {
                    color: #f92525;
                    font-size: 20px;
                }
               </style>



  </head>
  <body>
    <div id="overlay" class="overlay"></div>
    <div id="left" class="left">
      <div class="titi">
        <h2>étudiant</h2>
      </div>
      <ul>


      </ul>
    </div>
    <div class="right">
    


    <h4>Téléchargez la chapitres</h4>                          
        <div class="table-cont">
          <div class="div-table">
          <table>
            <thead>
              <tr>
              <th> titre</th>
                 <th> Cas de chapitres</th>
                 <th> Téléchargez la chapitres</th>


                 </tr>

            </thead>

            <?php
         $select_partie = $conn->prepare("SELECT * FROM `chapitre` WHERE cours_id = ? and partie_id = ? and status = ?");
         $select_partie->execute([$cours_id, $get_id, 'active']);
         if($select_partie->rowCount() > 0){
            while($fetch_partie = $select_partie->fetch(PDO::FETCH_ASSOC)){
               $partie_id = $fetch_partie['id'];
               $cours_is = $fetch_partie['cours_is'];

               ?>

            
            <tbody>
              <tr>

                <td>

                  <p><?= $fetch_partie['content']; ?></p>


                </td>
                
                <td>
                <a href=""><?= $fetch_partie['status']; ?></i></a>


            </td>

              

                <td>
                           
                <?php if ($fetch_partie['pdf'] != '') { ?>
                                <div class="attachment">
                            <a href="../uploaded_pdf/<?php echo $fetch_partie['pdf']; ?>" download="<?php echo $fetch_partie['pdf']; ?>">
                                <div class="attachment-icon pdf-icon">
                                    <i class="far fa-file-pdf"></i>
                                  <span class="pdf-link"><i class="fa-solid fa-down-long"></i></span>


                                </div>
                            </a>
                        </div>
                            <?php } ?>
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

  </body>
</html>