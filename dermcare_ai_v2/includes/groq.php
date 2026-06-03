<?php
require_once __DIR__ . '/config.php';
function call_groq(string $profile, string $products): string {
    if (!GROQ_API_KEY) {
        return "【離線推薦模式】\n尚未設定 GROQ_API_KEY，因此系統先使用資料庫商品進行保守推薦。\n\n建議做法：\n1. 先選擇低刺激、保濕、防曬等基礎品項。\n2. 敏感肌或嚴重泛紅者，先局部測試。\n3. 若有皮膚疾病、孕婦用藥或嚴重過敏，請諮詢醫師或藥師。\n\n系統已列出符合條件商品，正式上線後可由 Groq 產生更完整的推薦理由。";
    }
    $prompt = "你是藥妝推薦助理，請根據使用者需求與商品資料推薦。限制：不可診斷疾病、不可宣稱療效、不可編造商品；若有嚴重過敏、皮膚疾病、孕婦或用藥疑慮，請建議諮詢醫師或藥師。\n\n使用者資料：\n{$profile}\n\n可推薦商品資料：\n{$products}\n\n請用繁體中文輸出：1.推薦排序 2.推薦原因 3.成分注意事項 4.使用建議 5.何時該停止使用。";
    $payload = ['model'=>GROQ_MODEL,'messages'=>[['role'=>'system','content'=>'你是安全保守的藥妝資訊推薦助理。'],['role'=>'user','content'=>$prompt]],'temperature'=>0.35];
    $ch=curl_init('https://api.groq.com/openai/v1/chat/completions');
    curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_POST=>true,CURLOPT_HTTPHEADER=>['Authorization: Bearer '.GROQ_API_KEY,'Content-Type: application/json'],CURLOPT_POSTFIELDS=>json_encode($payload, JSON_UNESCAPED_UNICODE),CURLOPT_TIMEOUT=>30]);
    $res=curl_exec($ch); $err=curl_error($ch); curl_close($ch);
    if(!$res) return 'Groq API 連線失敗：'.$err;
    $json=json_decode($res,true);
    return $json['choices'][0]['message']['content'] ?? ('Groq 回覆解析失敗：'.$res);
}
