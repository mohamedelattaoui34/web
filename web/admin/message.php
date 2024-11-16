
<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($_SESSION['admin_id'])){
  header('location:login_admin.php');
}
$get_id = $_GET['formation_id'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

 


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
        }

        .chat-container {
            width: 100%;
            padding-top: 16px;            
            display: flex;
            flex-direction: column;
            overflow: scroll;
            height: 100%;
        }

        .message-container {
            margin-bottom: 5px;
        }

        .message {
            max-width: 100%;
            width: fit-content;
            border-radius: 10px;
            word-wrap: break-word;
            position: relative;
            text-align: end;
        }

        .admin-message {
            background-color: #03A9F4;
            color: #fff;
            border-radius: 15px;
            display: flex;
            width: fit-content;
            max-width: 88%;
            justify-content: center;
            align-items: center;
            gap: 5px;
            padding: 10px;
            align-self: end;
            margin-right: 10px;
            direction: ltr;
        }
        a {
            text-decoration: none;
            color: #353535;
            background: #fff;
            padding: 10px;
            border-radius: 10px;
            gap: 10px;
            display: flex;
        }

        .student-message {
            background-color: #efebeb80;
            color: #353535;
            border-radius: 15px;
            display: flex;
            direction: rtl;
            width: fit-content;
            font-size: 16px;
            max-width: 93%;
            justify-content: center;
            align-items: center;
            gap: 5px;
            padding: 10px;
            margin-left: 10px;
        }

        .sender-info {
            display: flex;
            align-items: center;
            margin-top: 5px;
        }

        .sender-name {
            font-weight: bold;
            margin-right: 5px;
            font-size: 0.9rem;
        }

        .sender-image {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .date {
            font-size: 0.8rem;
            color: #00000099;
        }

        .sender {
            font-size: 0.8rem;
            color: #888;
            margin-left: auto;
        }

        .post-editor {
            margin-top: 20px;
            position: absolute;
            width: 100%;
            height: 17%;
            background: white;
            bottom: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
        }

        .heading {
            font-size: 1.2rem;
            margin-bottom: 10px;
            text-align: center;
        }

        .box {
            width: 100%;
            height: 40px;
            padding-top: 13px;
            padding-left: 15px;
            border: none;
            border-radius: 10px;
            resize: none;
            outline: none;
            background: #eeeeee70;
            font-size: 18px;
            direction: ltr;
        }

        .flex-btn {
            display: flex;
            justify-content: flex-end;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        form {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 5px;
        }
        button{
            height: 45px;
            min-width: 45px;
            border-radius: 50%;
            border: none;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #03A9F4;
            color: white;
        }

        @media (min-width: 480px) {
            body{
                display: flex;
                justify-content: center;
                background: #eee;
            }
            .post-editor{
                border-radius: 0px;
                background: white;
                box-shadow: none;
            }
            .chat-container{
                overflow-x: auto;
                background: white;
            }
            .chat-container::-webkit-scrollbar {
                display: none;
            }
            .kiki {
                display: flex;
                gap: 20px;
                width: 81%;
            }
        }
    </style>

</head>

<body>

    <div class="chat-container">
        <?php
$select_messages = $conn->prepare("SELECT 'teacher' as source, 
       message_ense_env_groups.id, 
       message_ense_env_groups.content, 
       message_ense_env_groups.title_cours, 
       Enseignants.name as sender_name, 
       Enseignants.image as sender_image, 
       message_ense_env_groups.date as created_at 
FROM message_ense_env_groups 
INNER JOIN Enseignants ON message_ense_env_groups.Enseignants_id = Enseignants.id 
WHERE message_ense_env_groups.formation_id = ?

UNION ALL

SELECT 'student' as source, 
       message_étudiant_env_groups.id, 
       message_étudiant_env_groups.content, 
       NULL as title_cours, 
       étudiant.name as sender_name, 
       étudiant.image as sender_image, 
       message_étudiant_env_groups.date as created_at 
FROM message_étudiant_env_groups 
INNER JOIN étudiant ON message_étudiant_env_groups.étudiant_id = étudiant.id 
WHERE message_étudiant_env_groups.formation_id = ?

ORDER BY created_at DESC
");
$select_messages->execute([$get_id, $get_id]);


        if ($select_messages->rowCount() > 0) {
            $messages = $select_messages->fetchAll(PDO::FETCH_ASSOC);
            foreach ($messages as $message) {
                $source = $message['source'];
                $content = $message['content'];
                $title_cours = $message['title_cours'];
                $date = $message['created_at'];
                $sender_name = $message['sender_name'];
                $sender_image = $message['sender_image'];
                $class = ($source === 'teacher') ? 'admin-message' : 'student-message';
                $sender = ($source === 'teacher') ? '' : '';

                echo "<div class='message-container $class'>";
                echo "<div class='message'>$content</div>";
                if ($title_cours) {
                
                ?>

<?php
         $select_posts = $conn->prepare("SELECT * FROM `message_ense_env_groups` WHERE title_cours = ?");
         $select_posts->execute([$title_cours]);
         if($select_posts->rowCount() > 0){
        $fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)
        
      ?>
      <form method="post" class="boxx">

      <div class="pdf">
      <a> <?= $fetch_posts['title_cours']; ?>
      <i class="fa-solid fa-link"></i>
         </a>
      
    </div>

      </form>
      <?php
            
         }else{
         }
      ?>


<?php
                }
                echo "<div class='sender-info'>";
                echo "<img src='../uploaded_img/$sender_image' alt='sender' class='sender-image'>";
                echo "</div>";
                echo "<div class='date'>" . date("H:i", strtotime($date)) . "</div>";
                echo "</div>";
            }
        } else {
        }
        ?>
    </div>

    






</body>

</html>
