<?php require_once __DIR__.'/includes/layout.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $stmt=db()->prepare('INSERT INTO users(name,email,password,skin_type,allergy_note,role) VALUES(?,?,?,?,?,"member")');
  $stmt->execute([$_POST['name'],$_POST['email'],password_hash($_POST['password'],PASSWORD_DEFAULT),$_POST['skin_type']??'',$_POST['allergy_note']??'']);
  flash('註冊完成，請登入'); header('Location: login.php'); exit;
}
render_header('註冊'); ?>
<h1>會員註冊</h1><div class="panel"><form class="form" method="post"><div class="form-row"><div><label>姓名</label><input name="name" required></div><div><label>Email</label><input name="email" type="email" required></div></div><div class="form-row"><div><label>密碼</label><input name="password" type="password" required></div><div><label>膚質</label><select name="skin_type"><option>油性肌</option><option>乾性肌</option><option>混合肌</option><option>敏感肌</option><option>普通肌</option></select></div></div><label>過敏或避免成分</label><textarea name="allergy_note" placeholder="例如：酒精、香精、酸類、A醇"></textarea><button>建立帳號</button></form></div><?php render_footer(); ?>
