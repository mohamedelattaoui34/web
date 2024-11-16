


<?php

include './components/connect.php';

session_start();


if(isset($_SESSION['étudiant_id'])){
    $étudiant_id = $_SESSION['étudiant_id'];
 }else{
    $étudiant_id = '';
 };



 if(isset($_POST['envoyer'])){

    $messa = $_POST['messa'];
    $messa = filter_var($messa, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

       $insert_post = $conn->prepare("INSERT INTO `contact`(messa, name, email) VALUES(?,?,?)");
       $insert_post->execute([$messa, $name, $email]);
       $message[] = 'draft saved!';
    
  }
 


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-Nous</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
}

.header {
    background-color: #007bff;
    color: #fff;
    text-align: center;
    padding: 20px 0;
}
p {
    display: flex;
    gap: 10px;
}
a.fiwi {
    text-decoration: none;
    color: #007bff;
    gap: 10px;
    display: flex;
}

.header-content {
    max-width: 800px;
    margin: 0 auto;
}

.header-title {
    margin: 0;
}

.main-content {
    max-width: 800px;
    margin: 20px auto;
    padding: 0 20px;
}

.section-title {
    color: #007bff;
}

.contact-info,
.contact-form {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.contact-form label {
    display: block;
    margin-bottom: 5px;
}

.contact-form input,
.contact-form textarea {
    width: calc(100% - 22px); 
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.contact-form button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

.footer {
    background-color: #007bff;
    color: #fff;
    padding: 20px;
    text-align: center;
}

.footer-content {
    max-width: 800px;
    margin: 0 auto;
}

.social-links a {
    margin: 0 10px;
    color: #fff;
    font-size: 24px;
    text-decoration: none;
}

    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1 class="header-title">Contactez-Nous</h1>
        </div>
    </header>
    <main class="main-content">
        <section class="contact-info">
            <h2 class="section-title">Coordonnées</h2>
            <div class="contact-details">
                <p><i class="fas fa-map-marker-alt"></i> <strong>Adresse:</strong><a class="fiwi" href="https://maps.app.goo.gl/exSbL868Mxszk9U18"> École en Ligne, 123 Rue de l'Éducation, Tetueon, maroc</a></p>
                <p><i class="fas fa-phone-alt"></i> <strong>Téléphone:</strong><a class="fiwi" href="tel:+212647452397">+212 647 452 397</a></p>
                <p><i class="fas fa-envelope"></i> <strong>Email:</strong><a class="fiwi" href="mailto:contact@gmail.com">contact@gmail.com</a></p>
            </div>
        </section>
        <section class="contact-form">
            <h2 class="section-title">Formulaire de Contact</h2>
            <form id="contactForm" action="" method="post">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Message:</label>
                <textarea id="message" name="messa" rows="5" required></textarea>
                <button type="submit" name="envoyer">Envoyer</button>
            </form>
          
        </section>
    </main>
    <footer class="footer">
        <div class="footer-content">
            <p>Suivez-nous sur les réseaux sociaux:</p>
            <div class="social-links">
                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
