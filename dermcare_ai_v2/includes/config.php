<?php
define('APP_NAME', 'DermCare AI v2 藥妝推薦資訊系統');
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_NAME', getenv('DB_NAME') ?: 'dermcare_ai_v2');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: 'sf6210sf');
define('GROQ_API_KEY', getenv('GROQ_API_KEY') ?: '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');
define('GROQ_MODEL', getenv('GROQ_MODEL') ?: 'llama-3.1-8b-instant');
define('APP_DEBUG', true);
function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function base_url($path=''){ return './'.ltrim($path,'/'); }
