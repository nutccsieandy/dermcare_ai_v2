<?php require_once __DIR__.'/includes/layout.php'; render_header('首頁'); ?>
<section class="hero"><div><span class="kicker">AI 推薦 × 成分標籤 × 商品資料庫</span><h1>二代藥妝推薦資訊系統</h1><p class="lead">以問卷條件篩選商品，再由 Groq 生成推薦理由。適合做成資管專題、作品集與 AI 資訊系統展示。</p><div class="actions"><a class="btn" href="recommend.php">開始 AI 推薦</a><a class="btn secondary" href="products.php">查看商品庫</a></div></div><div class="art"><div class="chip a">敏感肌｜保濕｜防曬</div><div class="chip b">先 SQL 篩選，再由 AI 解釋推薦，降低亂編風險。</div></div></section>
<section class="grid"><div class="card"><h3>問卷推薦</h3><p>膚質、需求、預算、過敏條件都會納入篩選。</p></div><div class="card"><h3>AI 生成理由</h3><p>Groq API 會根據資料庫商品產生排序與注意事項。</p></div><div class="card"><h3>後台管理</h3><p>管理商品、品牌、分類、推薦紀錄與會員收藏。</p></div></section>
<?php render_footer(); ?>
