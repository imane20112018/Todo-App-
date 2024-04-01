<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <?php
    // if (!isset($_POST(['id']))) {
    //     header('location:index.php');
    // }
    require_once 'includes/database.php';
    include_once 'includes/nav.php';

    $id = $_POST['id'];
    $sqlstate = $pdo->prepare('SELECT * FROM items where id=?');
    $item = $sqlstate->execute([$id]);
    $item = $sqlstate->fetch(PDO::FETCH_OBJ);

    if (isset($_POST['modifier2'])) {
        $title = $_POST['title'];
        $id = $_POST['id'];
        if (!empty($id) && !empty($title)) {
            $sqlstate = $pdo->prepare("UPDATE items SET title =? WHERE id =?");
            $result = $sqlstate->execute([$title, $id]);
            if ($result == true) {
                header('location:index.php');
            }
        } else {
    ?>
            <div class="alert alert-danger" role="alert">
                Le titre est requise!
            </div>
    <?php
        }
    }
    ?>
    <div class="row-g-3 align-items-center">

        <div class="border border-info p-2 my-5 mx-auto w-75">
            <h4><b>Modifier une tache:</b> </h4>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $item->id ?>">
                <div class="col-auto">
                    <label for="title">Titre <span class="required">*</span> </label>
                    <input type="text" class=" success form-control " id="title" value="<?= $item->title ?>" name="title" placeholder="Le titre de la tache.">
                </div>
                <div class="col-auto">
                    <button type="submit" name="modifier2" class="btn btn-info rounded-3 my-2">Modifier</button>
                </div>
            </form>
        </div>

    </div>
</body>

</html>