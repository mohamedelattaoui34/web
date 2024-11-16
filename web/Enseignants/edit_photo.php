<?php

include '../components/connect.php';

session_start();

$Enseignants_id = $_SESSION['Enseignants_id'];

if(!isset($_SESSION['Enseignants_id'])){
  header('location:login_Enseignant.php');
}



if(isset($_POST['submit'])){


    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/'.$image;

    move_uploaded_file($image_tmp_name, $image_folder);

    
    $insert_user = $conn->prepare("UPDATE `Enseignants` SET image = ? WHERE id = ?");
    $insert_user->execute([$image, $Enseignants_id]);
    header('location:profile.php');


    

  
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

body {
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa;
    color: #333;
}

.container {
    max-width: 60px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.back-link {
    display: inline-block;
    margin-bottom: 20px;
    color: #0fbc7d;
    text-decoration: none;
    font-size: 18px;
    transition: color 0.3s ease;
}

.back-link:hover {
    color: #0ca166;
}

.user-details {
    text-align: center;
    margin-bottom: 20px;
}

.image-upload {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
}

.file-upload {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #f0f0f0;
    border: 2px dashed #ccc;
    border-radius: 10px;
    width: 100%;
    height: 100%;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

.file-upload:hover {
    border-color: #0fbc7d;
}

#image-preview {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    border-radius: 10px;
}

.file-upload p {
    margin-top: 10px;
    font-size: 16px;
    color: #666;
}

.file-upload i {
    font-size: 24px;
    color: #666;
    margin-bottom: 5px;
}

.button {
    text-align: center;
}

input[type="submit"] {
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    background-color: #0fbc7d;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0ca166;
}


form .button input {
    height: 100%;
    width: 100%;
    border-radius: 5px;
    border: none;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #0fbc7d;
}


</style>
        
        
        


        
<style>

</style>
    </head>
    <body>

    <a href="index.php" class="o"><i class="fa-solid fa-arrow-right" style="color:white; margin-right:3px; direction: rtl; font-size: 25px;"></i></a>
    <?php
$select_profile = $conn->prepare("SELECT * FROM `Enseignants` WHERE id = ?");
$select_profile->execute([$Enseignants_id]);
if ($select_profile->rowCount() > 0) {
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="user-details">

            <div class="kiki">
                <label for="image-input" class="file-upload">
                    <img id="image-preview" src="" alt="">
                    <div class="overlay" id="delete-overlay">
                        <i class="fa-solid fa-trash" id="delete-icon"></i>
                    </div>
                    <p class="det">Choisissez une image</p> 
                    <i class="fa-solid fa-camera"></i>
                    <input id="image-input" type="file" name="image" class="box" accept="image/*" style="display: none;">
                </label>
            </div>
        </div>
        <div class="button">
            <input type="submit" name="submit" value="Modifier"> 
        </div>
    </form>
<?php } ?>
</div>
</div>
</div>

<style>
    
    #delete-overlay {
        display: none;
    }
</style>

<script>
    const fileInput = document.getElementById("image-input");
    const imagePreview = document.getElementById("image-preview");
    const deleteOverlay = document.getElementById("delete-overlay");

    fileInput.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                imagePreview.src = event.target.result;
                deleteOverlay.style.display = "block"; 
            };
            reader.readAsDataURL(file);
        }
    });

    deleteOverlay.addEventListener("click", function() {
        imagePreview.src = ""; 
        fileInput.value = ""; 
        deleteOverlay.style.display = "none"; 
    });
</script>



    </body>
    </html>

