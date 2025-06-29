<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$query = "SELECT p.id, p.title, p.content, p.created_at, u.username
          FROM posts p
          JOIN users u ON p.user_id = u.id
          ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forum</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .post { margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 20px; }
        .post-title { margin-bottom: 5px; }
        .post-meta { color: #666; font-size: 0.8em; margin-bottom: 10px; }
        .btn { padding: 8px 12px; background-color: #4CAF50; color: white; text-decoration: none; display: inline-block; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Forum Diskusi</h2>
        <div>
            <span>Selamat datang, <?php echo $_SESSION['username']; ?>!</span>
            <a href="logout.php" style="margin-left: 15px;">Logout</a>
        </div>
    </div>
    
    <a href="create_post.php" class="btn">Buat Postingan Baru</a>
    
    <h3>Postingan Terbaru</h3>
    
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="post">
                <h3 class="post-title"><a href="view_post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h3>
                <div class="post-meta">
                    Oleh: <?php echo $row['username']; ?> |
                    Tanggal: <?php echo $row['created_at']; ?>
                </div>
                <div class="post-content">
                    <?php echo substr($row['content'], 0, 150); ?>...
                    <a href="view_post.php?id=<?php echo $row['id']; ?>">Baca selengkapnya</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Belum ada postingan.</p>
    <?php endif; ?>
</body>
</html>
