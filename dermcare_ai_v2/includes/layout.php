<?php
require_once __DIR__ . '/auth.php';
function render_header($title=APP_NAME){ $u=current_user(); ?>
<!doctype html><html lang="zh-Hant"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=h($title)?>｜<?=h(APP_NAME)?></title><link rel="stylesheet" href="assets/style.css"></head><body>
<header class="nav"><a class="brand" href="index.php"><span>DC</span><b>DermCare AI v2</b></a><nav>
<a href="index.php">首頁</a><a href="recommend.php">AI推薦</a><a href="products.php">商品庫</a><a href="history.php">紀錄</a><a href="favorites.php">收藏</a><?php if($u && $u['role']==='admin'): ?><a href="admin/index.php">後台</a><?php endif; ?><?php if($u): ?><a href="logout.php">登出</a><?php else: ?><a href="login.php">登入</a><a class="nav-cta" href="register.php">註冊</a><?php endif; ?>
</nav></header><main><?php if($m=flash()): ?><div class="alert"><?=h($m)?></div><?php endif; ?>
<?php }
function render_footer(){ ?>
</main><footer class="footer">本系統僅提供藥妝商品資訊與保養建議，不取代醫師、藥師或皮膚科診斷。</footer></body></html>
<?php }
