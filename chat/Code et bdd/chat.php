<?php
// Démarrage de la session PHP pour gérer les données de session
session_start();

// Vérification de la présence de la variable 'mail' dans la session
// Si non présente, redirige l'utilisateur vers la page de connexion
if (!isset($_SESSION["mail"])) {
    header("location: connexion.php");
    exit;  // Arrêt du script pour éviter toute exécution ultérieure après redirection
}

// Paramètres de connexion à la base de données
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "chat2";

// Connexion à la base de données avec gestion d'erreur
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) {
    die("Erreur de connexion : " . $mysqli->connect_error);  // Affichage de l'erreur et arrêt du script
}

// Récupération du pseudo de l'utilisateur à partir de la session
$pseudo = $_SESSION["nom"];

// Traitement du formulaire lorsqu'il est soumis
if (isset($_POST["bout"], $_POST["message"], $_POST["destinataire"])) {
    // Sécurisation des entrées en échappant les caractères spéciaux pour prévenir les injections SQL
    $message = $mysqli->real_escape_string($_POST["message"]);
    $destinataire = $mysqli->real_escape_string($_POST["destinataire"]);
    
    // Préparation de la requête SQL pour insérer un nouveau message
    $query = "INSERT INTO messages (pseudo, message, date, destinataire) VALUES (?, ?, NOW(), ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sss", $pseudo, $message, $destinataire);
    $stmt->execute();  // Exécution de la requête
    $stmt->close();  // Fermeture du statement
}

$mysqli->close();  // Fermeture de la connexion à la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Lien de déconnexion pour l'utilisateur -->
    <a href="deconnexion.php">Déconnexion</a><br>
    <?php if ($_SESSION["niveau"] == 2): ?>
        <!-- Lien pour ajouter un utilisateur, visible seulement pour les utilisateurs de niveau 2 -->
        <a href="ajoutUser.php">Ajouter un utilisateur</a>
    <?php endif; ?>
    <div class="container">
        <header>
            <!-- Affichage personnalisé du prénom de l'utilisateur -->
            <h1>Bonjour <?php echo htmlspecialchars($_SESSION["prenom"]); ?>, chattez en direct!</h1>
        </header>
        <div class="messages">
            <ul>
                <?php
                // Reconnexion à la base de données
                $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
                // Préparation et exécution de la requête pour obtenir les messages destinés à l'utilisateur ou à tous
                $query = "SELECT * FROM messages WHERE destinataire = ? OR destinataire = 'tous' ORDER BY date";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param("s", $pseudo);
                $stmt->execute();
                $result = $stmt->get_result();  // Récupération du résultat
                // Boucle sur les messages reçus et affichage
                while ($row = $result->fetch_assoc()) {
                    echo "<li class='message'>" . htmlspecialchars($row["date"]) . " - " .
                         htmlspecialchars($row["pseudo"]) . " - " .
                         htmlspecialchars($row["message"]) . "</li>";
                }
                $stmt->close();
                $mysqli->close();
                ?>
            </ul>
        </div>
        <div class="formulaire">
            <!-- Formulaire pour envoyer un nouveau message -->
            <form action="" method="post">
                <input type="text" name="message" placeholder="Message :" required>
                <select name="destinataire">
                    <!-- Option par défaut pour tous les utilisateurs -->
                    <option value="tous">tous</option>
                    <?php
                    // Réouverture de la connexion et récupération des noms d'utilisateurs pour le menu déroulant
                    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
                    $query = "SELECT * FROM user ORDER BY nom";
                    if ($result = $mysqli->query($query)) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row["nom"]) . "'>" . htmlspecialchars($row["nom"]) . "</option>";
                        }
                    }
                    $mysqli->close();
                    ?>
                </select>
                <input type="submit" value="Envoyer" name="bout">
            </form>
        </div>
    </div>
</body>
</html>
