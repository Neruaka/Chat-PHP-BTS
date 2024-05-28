<?php
session_start();
if (!isset($_SESSION["mail"]) || $_SESSION["niveau"] != 2) {
    header("location: connexion.php");
    exit;
}

// Paramètres de connexion à la base de données
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "chat2";

// Connexion à la base de données
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) {
    die("Erreur de connexion : " . $mysqli->connect_error);
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["mdp"])) {
    $nom = $mysqli->real_escape_string($_POST["nom"]);
    $prenom = $mysqli->real_escape_string($_POST["prenom"]);
    $mail = $mysqli->real_escape_string($_POST["mail"]);
    $mdp = password_hash($mysqli->real_escape_string($_POST["mdp"]), PASSWORD_DEFAULT);  // Hashage du mot de passe
    $niveau = isset($_POST["niveau"]) ? (int)$_POST["niveau"] : 1;  // Niveau par défaut à 1 si non spécifié

    // Préparation de la requête d'insertion
    $stmt = $mysqli->prepare("INSERT INTO user (nom, prenom, mail, mdp, niveau) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nom, $prenom, $mail, $mdp, $niveau);
    if ($stmt->execute()) {
        echo "<p>Utilisateur ajouté avec succès!</p>";
    } else {
        echo "<p>Erreur : " . $stmt->error . "</p>";
    }
    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    /* Réinitialisation de base et styles globaux */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    font-size: 16px;
    background-color: #121212; /* Fond très sombre */
    color: #e0e0e0; /* Texte clair pour contraste élevé */
    line-height: 1.6;
}

/* Conteneur principal pour le formulaire */
.container {
    background-color: #333; /* Fond sombre pour le conteneur */
    width: 50%;
    max-width: 600px;
    margin: 5% auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); /* Ombre pour effet de profondeur */
}

/* Style du titre */
header h1 {
    font-size: 24px;
    color: #00bfa5; /* Couleur accent claire pour le titre */
    text-align: center;
    margin-bottom: 20px;
}

/* Styles pour les étiquettes des champs */
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #b0bec5; /* Gris clair pour les étiquettes */
}

/* Styles des champs de saisie */
input[type='text'],
input[type='email'],
input[type='password'],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #424242; /* Bordure plus sombre */
    background-color: #2c2c2c; /* Fond des champs plus sombre */
    color: #fff; /* Texte blanc pour contraste */
    border-radius: 4px;
    transition: all 0.3s;
}

input[type='text']:focus,
input[type='email']:focus,
input[type='password']:focus,
select:focus {
    border-color: #00bfa5; /* Bordure couleur accent lors de la sélection */
    box-shadow: 0 0 8px rgba(0, 191, 165, 0.5); /* Ombre douce */
}

/* Bouton de soumission */
input[type='submit'] {
    width: 100%;
    padding: 12px;
    background-color: #00bfa5; /* Couleur accent pour le bouton */
    color: white;
    font-size: 18px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type='submit']:hover {
    background-color: #00897b; /* Variation de couleur au survol */
}

</style>
<body>
    <div class="container">
        <header>
            <h1>Ajouter un nouvel utilisateur</h1>
        </header>
        <form method="post" action="">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" required>
            
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" required>
            
            <label for="mail">Email</label>
            <input type="email" id="mail" name="mail" required>
            
            <label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mdp" required>
            
            <label for="niveau">Niveau d'accès</label>
            <select id="niveau" name="niveau">
                <option value="1">Utilisateur</option>
                <option value="2">Admin</option>
            </select>
            
            <input type="submit" value="Ajouter">
        </form>
    </div>
</body>
</html>

