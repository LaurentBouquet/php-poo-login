<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Gestion des utilisateurs</title>
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
        <?php
        if (!empty($_SESSION['message'])) {
          echo '<div class="alert alert-success" role="alert">
                                ' . $_SESSION['message'] . '
                            </div>';
          $_SESSION['message'] = "";
        }
        ?>
        <h1>Gestion des utilisateurs</h1>
        <table class="table">
          <tr>
            <td><a href="User/add.php" class="btn btn-primary">Ajouter un utilisateur</a></td>
          </tr>
          <tr>
            <td><a href="User/index.php" class="btn btn-primary">Liste des utilisateurs</a></td>
          </tr>
          <tr>
            <td><a href="User/connect.php" class="btn btn-primary">Se connecter</a></td>
          </tr>
        </table>
      </section>
    </div>
  </main>
</body>

</html>