<?php

include '../components/connect.php';

session_start();

$Enseignants_id = $_SESSION['Enseignants_id'];

if(!isset($_SESSION['Enseignants_id'])){
  header('location:login_Enseignant.php');
}

$get_id = $_GET['partie_id'];
$cours_id = $_GET['cours_id']; 

if(isset($_POST['submit'])){


    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);


    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);


    if(isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $pdf = $_FILES['pdf']['name'];
        $pdf_tmp_name = $_FILES['pdf']['tmp_name'];
        $pdf_folder = '../uploaded_pdf/' . $pdf;
        if(move_uploaded_file($pdf_tmp_name, $pdf_folder)) {

   $insert_user = $conn->prepare("INSERT INTO `chapitre`(Enseignants_id, pdf, status, content, cours_id, partie_id) VALUES(?,?,?,?,?,?)");
   $insert_user->execute([$Enseignants_id, $pdf, $_POST['status'], $content, $cours_id, $get_id]);
   $message[] = ' size  too large!';
} else {
    echo "Error uploading file.";
  }
}

}


?>





<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Enregistrement</title>
    <link rel="stylesheet" href="stylee.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>


<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Amiri', serif;
    }
    body{
        height: 100vh;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        background:#f5f7fb;
        padding: 10px;
        direction: rtl
    }
    .container{
        max-width: 589px;
        padding: 25px 30px;
        background: white;

        border-radius: 12px;
        box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
    }
    .container .title::before {
        content: "";
        position: absolute;
        right: 0;
        bottom: 0;
        height: 3px;
        width: 30px;
        border-radius: 5px;
        background: #4f4fe1;
    }
    .title{
        font-size: 25px;
        font-weight: 500;
        position: relative;
        color: #6b6b6b;
    }
    .user-details{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin: 20px 0 12px 0;
        color: #4b4a4a;
        width: 486px;
        font-size: 16px;
        font-weight: bolder;
    }
    .one , .two , .three , .four , .fivee , .six {
        position: relative;
    }
    .input-box {
        display: flex;
        gap: 9px;
    }
    input[type="submit"] {
        width: 112px;
        align-self: center;
        height: 6vh;
        border: none;
        color: black;
        background: linear-gradient(90deg, #00BCD4, #03a9f46e);
        border-radius: 4px;
        margin: 11px 21px 0px 0px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    input[type="submit"]:hover{
        scale: 1.1;
    }
    p , span.details{
        position: absolute;
        z-index: 2;
        background: white;
        width: fit-content;
        padding: 0px 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-size: 13px;
        color: #777777;
        top: -10px;
        left: 32px;
        height: 19px;
    }
    input[type="text"], input[type="password"],  input[type="email"], input[type="numbre"], select.box {
        position: relative;
        height: 39px;
        border: 0.5px lightgrey solid;
        border-radius: 9px;
        z-index: 1;
        font-size: 17px;
        padding-right: 15px;
        width: 218px;
    }
    input[type="text"]:focus, input[type="password"]:focus,  input[type="email"], input[type="numbre"]:focus, select.box {
        outline: none;            
    }
    .box{
        font-size: 17px;
        color: #515151;
    }
    .boxy {
        position: relative;
        display: inline;
    }
    form {
        display: flex;
        flex-direction: column;
    }

    @media (max-width: 480px)  {
        body{
            direction: ltr;
        }
        .container {
            width: 315px;
            padding: 25px 30px;
            background: white;
            border-radius: 12px;
            box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
            direction: rtl;
        }
        .content {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .user-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 20px 0 12px 0;
            color: #4b4a4a;
            width: 220px;
            font-size: 16px;
            font-weight: bolder;
        }
        form {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }
        input[type="submit"] {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 6vh;
            border: none;
            color: black;
            background: linear-gradient(90deg, #00BCD4, #03a9f46e);
            border-radius: 4px;
            padding: 0;
            margin: 0;
            width: 100%;
        }
        .box{
            margin-bottom: 10px;
        }
        p , span.details{
            left: 20px;
        }
    }

    .file-upload {
            display: flex;
            align-items: center;
            background-color: white;
            border: none;
            border-radius: 5px;
            width: 101px;
            height: auto;
            padding: 10px;
            margin-bottom: 15px;
            cursor: pointer;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.1);
        }
        .det {
            position:  absolute ;
            top: 5px;
            right: 11px;
        }
        i.fa-solid.fa-camera {
            z-index: 10;
        }
        .kiki{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .file-upload{
            position: relative;
        }

    .file-upload input[type="file"] {
        display: none;
    }
    .preview-image {
        width: 100px; 
        height: 100px; 
        object-fit: cover; 
        border-radius: 5px;
        margin-top: 10px; 
    }
    .delete-button {
        position: absolute;
        top: 0%;
        right: 0%;
        background: white;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10; 
        }
        i.fa-solid.fa-trash {
            color: #959595;
            font-size: 16px;
        }
        @media (max-width:500px) {
            .delete-button {
        position: absolute;
        top: 0%;
        right: 0%;
        z-index: 10; 
        }
        }
</style>



<body>





  <div class="container">
    <div class="title">Enregistrement</div>
    <div class="content">

        <form action="#"  method="post" enctype="multipart/form-data">
            <div class="user-details">

                <div class="one">
                    <span class="details">Titre du cours</span>
                    <input type="text" name="content" required>
                </div>
            </div>
            <span> PDF</span>
            <label for="pdf-input" class="file-upload">
                <i class="fa-solid fa-file"></i>
                <input id="pdf-input" type="file" name="pdf" class="box" accept=".pdf" style="display: none;">
            </label>


            <span>statut</span>
          <select name="status" class="box" required>
            <option selected></option>
            <option value="active">actif</option>
            <option value="deactive">inactif</option>
          </select>  

            



<input type="submit" name="submit" value="Enregistrement">

        </form>
        </div>
    </div>



    <script>
    const input = document.getElementById('video-input');
    const previewContainer = document.getElementById('image-preview');
    const previewVideo = document.getElementById('preview');
    const deleteButton = document.getElementById('delete-button');

    input.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function() {
                previewVideo.src = reader.result;
                previewContainer.style.display = 'flex'; 
            };

            reader.readAsDataURL(file);
        }
    });

    deleteButton.addEventListener('click', function() {
        previewVideo.src = '';
        previewContainer.style.display = 'none'; 
        input.value = ''; 
    });
</script>
</body>
</html>

















