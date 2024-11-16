<?php

include '../components/connect.php';

session_start();

$Enseignants_id = $_SESSION['Enseignants_id'];

if(!isset($_SESSION['Enseignants_id'])){
  header('location:login_Enseignant.php');
}


$get_id = $_GET['admin_id'];

if (isset($_POST['publish'])) {

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);

    $Enseignants_id = $_POST['Enseignants_id'];
    $Enseignants_id = filter_var($Enseignants_id, FILTER_SANITIZE_STRING);
    
    $admin_id = $_POST['admin_id'];
    $admin_id = filter_var($admin_id, FILTER_SANITIZE_STRING);
    
    $insert_post = $conn->prepare("INSERT INTO `message_Enseignants_admin` (Enseignants_id, content, admin_id) VALUES (?,?,?)");
    $insert_post->execute([$Enseignants_id, $content, $get_id]);
}

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
            height: 88%;
            max-height: 88%;
        }

        .message-container {
            margin-bottom: 5px;
        }

        .message {
            max-width: 80%;
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
            direction: rtl;
            width: fit-content;
            min-width: 102px;
            height: 50px;
            justify-content: center;
            align-items: center;
            gap: 5px;
            padding: 10px;
            align-self: end;
            margin-right: 10px;
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
            height: 12%;
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
            height: 48px;
            direction: ltr;
            padding-top: 13px;
            padding-right: 15px;
            border: none;
            border-radius: 50px;
            resize: none;
            outline: none;
            background: #eeeeee70;
            font-size: 18px;
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
        }
    </style>

</head>

<body>
<div class="chat-container">
        <?php
$select_messages = $conn->prepare("SELECT 'teacher' as source, 
       message_Enseignants_admin.id, 
       message_Enseignants_admin.content, 
       Enseignants.name as sender_name, 
       Enseignants.image as sender_image, 
       message_Enseignants_admin.date as created_at 
FROM message_Enseignants_admin
INNER JOIN Enseignants ON message_Enseignants_admin.Enseignants_id = Enseignants.id 
WHERE message_Enseignants_admin.Enseignants_id = ? AND message_Enseignants_admin.admin_id = ?

UNION ALL

SELECT 'student' as source, 
message_admin_enseig.id, 
message_admin_enseig.content, 
admine.name as sender_name, 
admine.image as sender_image, 
       message_admin_enseig.date as created_at 
FROM message_admin_enseig
INNER JOIN admine ON message_admin_enseig.admin_id = admine.id 
WHERE message_admin_enseig.Enseignants_id = ? AND message_admin_enseig.admin_id = ?

ORDER BY created_at DESC
");

$select_messages->execute([$Enseignants_id, $get_id, $Enseignants_id, $get_id]);

        if ($select_messages->rowCount() > 0) {
            $messages = $select_messages->fetchAll(PDO::FETCH_ASSOC);
            foreach ($messages as $message) {
                $source = $message['source'];
                $content = $message['content'];
                $date = $message['created_at'];
                $sender_name = $message['sender_name'];
                $sender_image = $message['sender_image'];
                $class = ($source === 'teacher') ? 'admin-message' : 'student-message';
                $sender = ($source === 'teacher') ? '' : '';

                echo "<div class='message-container $class'>";
                echo "<div class='message'>$content</div>";
                
                echo "<div class='sender-info'>";
                echo "</div>";
                echo "<div class='date'>" . date("H:i", strtotime($date)) . "</div>";
                echo "</div>";
            }
        } else {
        }
        ?>
    </div>

    
    <section class="post-editor" dir="rtl">


        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="admin_id" value="<?= $get_id; ?>">
            <input type="hidden" name="Enseignants_id" value="<?= $Enseignants_id; ?>">

            <textarea name="content" class="box" required maxlength="10000" placeholder=" entrer..."></textarea>


            <button name="publish" type="submit" ><i class="fa-solid fa-paper-plane"></i></button>
        </form>

    </section>




</body>

</html>
