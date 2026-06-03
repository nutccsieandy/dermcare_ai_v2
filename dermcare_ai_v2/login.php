<?php require_once __DIR__.'/includes/layout.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $stmt=db()->prepare('SELECT * FROM users WHERE email=?'); $stmt->execute([$_POST['email']]); $u=$stmt->fetch();
  if($u && password_verify($_POST['password'],$u['password'])){ $_SESSION['user_id']=$u['id']; header('Location: index.php'); exit; }
  flash('登入失敗，請確認帳號密碼');
}
render_header('登入'); ?>
<h1>登入</h1><div class="panel"><form class="form" method="post"><label>Email</label><input name="email" type="email" value="admin@example.com" required><label>密碼</label><input name="password" type="password" value="admin123" required><button>登入</button><p class="small">預設管理員：admin@example.com / admin123。正式部署請修改。</p></form></div><?php render_footer(); ?>
