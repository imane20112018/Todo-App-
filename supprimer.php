<?php
require_once 'includes/database.php';
if (isset($_POST['supprimer'])) {
    $id = $_POST['id'];
    $sqlstate = $pdo->prepare('DELETE FROM items WHERE id=?');
    $result = $sqlstate->execute([$id]);
    header('location: index.php');
}
