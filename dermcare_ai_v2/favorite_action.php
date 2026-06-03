<?php require_once __DIR__.'/includes/auth.php'; require_login();
$pid=(int)($_POST['product_id']??0); if($pid){$st=db()->prepare('INSERT IGNORE INTO favorites(user_id,product_id) VALUES(?,?)');$st->execute([current_user()['id'],$pid]);}
flash('已加入收藏'); header('Location: products.php'); exit;
