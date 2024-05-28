<?php
session_start();
if(isset($_POST["bout"])){
    $mail = $_POST["mail"];
    $mdp = $_POST["mdp"];
    $id = mysqli_connect("localhost","root","","chat2");
    $req = "SELECT * FROM user WHERE mail='$mail' and mdp='$mdp'";
    $res = mysqli_query($id, $req);
    $ligne = mysqli_fetch_assoc($res);
    if(mysqli_num_rows($res)>0){ //mysqli_num_rows compte le nombre de ligne dans $res
        $_SESSION["mail"] = $mail;
        $_SESSION["nom"] = $ligne["nom"];
        $_SESSION["prenom"] = $ligne["prenom"];
        $_SESSION["niveau"] = $ligne["niveau"];
        header("location:chat.php");
    }else $erreur = "<h3>Erreur de login ou de mot de passe!!!</h3>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Formulaire de connexion</h1><hr>
    <form action="" method="post">
        <p><input type="text" name="mail" placeholder="Entrez votre login/mail :" required></p>
        <p><input type="password" name="mdp" placeholder="Mot de passe :" required></p>
        <?php if(isset($erreur)) echo $erreur?>
        <p><input type="submit" value="Connexion" name="bout"></p>
    </form><hr>
</body>
</html>