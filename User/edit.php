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

    if ($_POST) {
        if (
            isset($_POST['id']) && !empty($_POST['id'])
            && isset($_POST['email']) && !empty($_POST['email'])
        ) {

            // On nettoie les données envoyées
            $id = strip_tags($_POST['id']);
            $email = strip_tags($_POST['email']);

            $user = $manager->getOneById($id);

            // On vérifie si le type existe
            if (!$user) {
                // On rédige le message d'erreur qui sera affiché à l'utilisateur
                $_SESSION['error'] = "Cet id n'existe pas";

                // On renvoie vers la page principale
                header('Location: index.php');
                exit();
            }

            // Modifier le type
            $user->setEmail($email);
            $manager->update($user);

            // On rédige le message qui sera affiché à l'utilisateur
            $_SESSION['message'] = "User modifié";

            // On renvoie vers la page principale
            header('Location: index.php');
        } else {
            // On rédige le message d'erreur qui sera affiché à l'utilisateur
            $_SESSION['error'] = "Le formulaire est incomplet";

            // On renvoie vers la page principale
            header('Location: index.php');
        }
    }

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
    <title>Modifier un utilisateur</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                if (!empty($_SESSION['error'])) {
                    echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['error'] . '
                            </div>';
                    $_SESSION['error'] = "";
                }
                ?>
                <h1>Modifier un utilisateur</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control" value="<?= $user->getEmail() ?>">
                    </div>
                    <input type="hidden" value="<?= $user->getId() ?>" name="id">
                    <button class="btn btn-primary">Enregistrer</button>
                </form>
            </section>
        </div>
    </main>
</body>

</html>