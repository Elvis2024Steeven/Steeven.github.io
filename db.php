<?php
// connection avec la base de donnée via PDOStatement
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "my_portfolio";
$dsn = "mysql:host=localhost;dbname=my_portfolio";

// récupération des données du Formulaire
$email = $_POST["email"];
$message = $_POST["message"];

// vérifier la connexion
try {
    $pdo = new PDO($dsn, $user, $pass);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // préparation pour envoyer la requête SQL
    $req = $pdo->prepare("INSERT INTO contacts (email, message) VALUES (:email, :message)");
    $req->bindParam(':email', $email);
    $req->bindParam(':message', $message);

    if ($req->execute()) {
        $statusMessage = "Merci de m'avoir Contacter, Je vous ferais un retour d'ici peu !";
        $statusClass = "success";
    } else {
        $statusMessage = " Veuillez réessayer.";
        $statusClass = "error";
    }
} catch (PDOException $e) {
    $statusMessage = "Erreur " . $e->getMessage();
    $statusClass = "error";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'Enregistrement</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 1.8em;
            margin-bottom: 20px;
        }

        .message {
            font-size: 1.2em;
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            color: #fff;
        }

        .success {
            background-color: #28a745;
        }

        .error {
            background-color: #dc3545;
        }

        .message a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .message a:hover {
            text-decoration: underline;
        }

        .btn-home {
            display: inline-block;
            margin-top: 30px;
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-home:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Confirmation</h1>
        <div class="message <?php echo $statusClass; ?>">
            <p><?php echo $statusMessage; ?></p>
            <?php if ($statusClass == 'success') : ?>
                <p><a href="index.html" class="btn-home">Retour à l'accueil</a></p>
            <?php else : ?>
                <p>Veuillez essayer à nouveau ou contactez-moi pour toute assistance.</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
