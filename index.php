<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <?php require_once 'includes/database.php'; ?>
    <?php include_once 'includes/nav.php'; ?>
    <div class="container">
        <div class="row-g-3 align-items-center">
            <?php
            $title = '';
            if (isset($_POST['ajouter'])) {
                $title = htmlspecialchars($_POST['title']);
                if (!empty($title)) {
                    $sqlstate = $pdo->prepare('INSERT INTO items VALUES(null,?)');
                    $result = $sqlstate->execute([$title]);
                    if ($result == true) {
            ?>
                        <div class="alert alert-success" role="alert">
                            <?= "Le titre que vous avez entrer est: $title"; ?>
                        </div>
                    <?php  }
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Le titre est requise!
                    </div>
            <?php
                }
            }
            ?>
            <div class="border border-success p-2 my-5 mx-auto w-75">
                <form method="post">
                    <h4>Ajouter une nouvelle tache:</h4>
                    <div class="col-auto">
                        <label for="title">Titre <span class="required">*</span> </label>
                        <input type="text" class="form-control" id="title" value="" name="title" placeholder="Le titre de la tache.">
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="ajouter" class="btn btn-primary rounded-3 my-2">Ajouter</button>
                    </div>
                </form>
            </div>

        </div>
        <?php
        $sqlstate2 = $pdo->query('SELECT * FROM items');
        $items = $sqlstate2->fetchAll(PDO::FETCH_OBJ);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre de la Tache</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $key => $item) { ?>
                    <tr>
                        <td span class="badge rounded-pill bg-primary text-white"><?= $item->id; ?></span>
                        </td>
                        <td><?= $item->title; ?></td>
                        <td>
                            <form method="post">
                                <input type="text" name="" id="" value="<?php echo $item->id ?>">
                                <input type="submit" class="btn btn-primary" value="&#9999;" name="modifier">
                                <input type="submit" class="btn btn-danger" value="&#10006;" name="supprimer">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>