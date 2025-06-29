<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$post_id = $_GET['id'];

$query = "SELECT p.id, p.title, p.content, p.created_at, u.username
          FROM posts p
          JOIN users u ON p.user_id = u.id
          WHERE p.id = $post_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit;
}

$post = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $post['title']; ?></title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .post { margin-bottom: 30px; }
        .post-title { margin-bottom: 5px; }
        .post-meta { color: #666; font-size: 0.8em; margin-bottom: 15px; }
        .post-content { line-height: 1.6; }
        .comments-container { margin-top: 30px; }
        .comment { background-color: #f9f9f9; padding: 10px; margin-bottom: 10px; border-radius: 4px; }
        .comment-date { color: #666; font-size: 0.8em; }
        .comment-form { margin-top: 20px; }
        textarea { width: 100%; height: 100px; padding: 8px; margin-bottom: 10px; }
        button { padding: 8px 15px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <p><a href="index.php">← Kembali ke Forum</a></p>
    
    <div class="post">
        <h2 class="post-title"><?php echo $post['title']; ?></h2>
        <div class="post-meta">
            Oleh: <?php echo $post['username']; ?> |
            Tanggal: <?php echo $post['created_at']; ?>
        </div>
        <div class="post-content">
            <?php echo $post['content']; ?>
        </div>
    </div>
    
    <div class="comments-container">
        <h3>Komentar:</h3>
        
        <?php
        $query = "SELECT c.content, u.username, c.created_at
                  FROM comments c
                  JOIN users u ON c.user_id = u.id
                  WHERE c.post_id = $post_id
                  ORDER BY c.created_at DESC";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='comment'>";
                echo "<strong>" . $row['username'] . "</strong> <span class='comment-date'>" . $row['created_at'] . "</span><br>";
                echo $row['content']; // BAGIAN RENTAN XSS!
                echo "</div>";
            }
        } else {
            echo "<p>Belum ada komentar.</p>";
        }
        ?>
        
        <div class="comment-form">
            <h4>Tambahkan komentar:</h4>
            <form action="add_comment.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <textarea name="comment" required></textarea>
                <button type="submit">Kirim Komentar</button>
            </form>
        </div>
    </div>
</body>
</html>
