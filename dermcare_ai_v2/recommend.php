<?php require_once __DIR__.'/includes/layout.php'; require_once __DIR__.'/includes/groq.php'; render_header('AI推薦');
$result=''; $matched=[];
if($_SERVER['REQUEST_METHOD']==='POST'){
  $skin=$_POST['skin_type']; $goal=$_POST['goal']; $budget=(int)$_POST['budget']; $avoid=$_POST['avoid']??''; $note=$_POST['note']??'';
  $sql='SELECT * FROM products WHERE price<=? AND skin_types LIKE ? AND (concerns LIKE ? OR category LIKE ?) ORDER BY price ASC LIMIT 8';
  $st=db()->prepare($sql); $st->execute([$budget,'%'.$skin.'%','%'.$goal.'%','%'.$goal.'%']); $matched=$st->fetchAll();
  if(!$matched){$st=db()->prepare('SELECT * FROM products WHERE price<=? ORDER BY price ASC LIMIT 8');$st->execute([$budget]);$matched=$st->fetchAll();}
  $plist=''; foreach($matched as $p){$plist.="#{$p['id']} {$p['brand']} {$p['name']} / {$p['category']} / NT$ {$p['price']} / 膚質: {$p['skin_types']} / 成分: {$p['ingredients']} / 避免: {$p['avoid_for']} / 說明: {$p['description']}
";}
  $profile="膚質：{$skin}
目標：{$goal}
預算：{$budget}
避免成分：{$avoid}
補充：{$note}";
  $result=call_groq($profile,$plist);
  $uid=current_user()['id']??null; $log=db()->prepare('INSERT INTO recommendation_logs(user_id,skin_type,goal,budget,avoid_note,user_note,matched_products,ai_response) VALUES(?,?,?,?,?,?,?,?)'); $log->execute([$uid,$skin,$goal,$budget,$avoid,$note,json_encode(array_column($matched,'id')), $result]);
}
?>
<h1>AI 藥妝推薦問卷</h1><div class="panel"><form class="form" method="post"><div class="form-row"><div><label>膚質</label><select name="skin_type"><option>油性肌</option><option>乾性肌</option><option>混合肌</option><option>敏感肌</option><option>普通肌</option></select></div><div><label>需求</label><select name="goal"><option>保濕</option><option>控油</option><option>痘痘</option><option>防曬</option><option>舒緩</option><option>亮白</option></select></div></div><div class="form-row"><div><label>預算上限</label><input name="budget" type="number" value="800" min="100"></div><div><label>避免成分</label><input name="avoid" placeholder="酒精、香精、酸類、A醇"></div></div><label>補充說明</label><textarea name="note" placeholder="例如：最近臉頰泛紅、T字油、希望白天可用"></textarea><button>產生推薦</button></form></div>
<?php if($result): ?><h2>AI 推薦結果</h2><div class="result"><?=h($result)?></div><h2>系統先篩出的商品</h2><div class="products"><?php foreach($matched as $p): ?><div class="product"><h3><?=h($p['brand'])?>｜<?=h($p['name'])?></h3><p><span class="tag"><?=h($p['category'])?></span><span class="tag"><?=h($p['skin_types'])?></span></p><p><?=h($p['description'])?></p><div class="price">NT$ <?=h($p['price'])?></div></div><?php endforeach; ?></div><?php endif; ?><?php render_footer(); ?>
