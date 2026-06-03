<?php
require_once __DIR__ . '/db.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
function current_user(){
    if (empty($_SESSION['user_id'])) return null;
    $stmt=db()->prepare('SELECT id,name,email,role,skin_type,allergy_note FROM users WHERE id=?');
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch() ?: null;
}
function require_login(){ if(!current_user()){ header('Location: login.php'); exit; } }
function require_admin(){ $u=current_user(); if(!$u || $u['role']!=='admin'){ http_response_code(403); exit('403 Forbidden'); } }
function flash($msg=null){ if($msg!==null){ $_SESSION['flash']=$msg; return; } $m=$_SESSION['flash']??''; unset($_SESSION['flash']); return $m; }
