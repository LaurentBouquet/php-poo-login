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

        // Supprimer le type
        $manager->remove($user);

        // On rédige le message qui sera affiché à l'utilisateur
        $_SESSION['message'] = "User supprimé";

        // On renvoie vers la page principale
        header('Location: index.php');
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
