<?php
// On démarre une session
session_start();

// On inclut le Manager
require_once('Manager/UsersManager.php');

// On inclut la classe User
require_once('Entity/User.php');

// On inclut le fichier de configuration
require_once("../conf.php");

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Si toutes les colonnes sont converties en string

    // Créer une instance de la classe UsersManager (un objet $manager)
    $manager = new UsersManager($db);


    // Est-ce que l'id existe et n'est pas vide dans l'URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {

        // On nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        $user = $manager->getOneById($id);

        // On vérifie si le type existe
        if (!$user) {
            // On rédige le message d'erreur qui sera affiché à l'utilisateur
            $_SESSION['error'] = "Cet id n'existe pas";

            // On renvoie vers la page principale
            header('Location: index.php');
            exit();
        }
    } else {
        // On rédige le message d'erreur qui sera affiché à l'utilisateur
        $_SESSION['error'] = "URL invalide";

        // On renvoie vers la page principale
        header('Location: index.php');
        exit();
    }
} catch (PDOException $e) {
    print('<br/>Erreur de connexion : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du type de livre </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Détails du type de livre <?= $user->getEmail() ?></h1>
                <p>ID : <?= $user->getId() ?></p>
                <p>Email : <?= $user->getEmail() ?></p>
                <p><a href="index.php">Retour</a> <a href="edit.php?id=<?= $user->getId() ?>">Modifier</a></p>
            </section>
        </div>
    </main>
</body>

</html>