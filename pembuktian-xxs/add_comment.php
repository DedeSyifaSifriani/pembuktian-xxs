<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);  
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];
    
    $query = "INSERT INTO comments (content, post_id, user_id) VALUES ('$comment', $post_id, $user_id)";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
}

header("Location: view_post.php?id=" . $post_id);
exit;
?>
