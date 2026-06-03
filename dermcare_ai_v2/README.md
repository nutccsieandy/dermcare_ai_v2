# DermCare AI v2 藥妝推薦資訊系統

## 技術
- PHP 8+
- MySQL / MariaDB
- Groq API，可不設定 API Key，系統會使用離線推薦模式
- RWD 漸層 UI

## 二代功能
- 會員註冊 / 登入
- AI 藥妝推薦問卷
- SQL 先篩商品，AI 再產生推薦理由
- 商品收藏
- 推薦紀錄
- 後台儀表板
- 後台商品新增與推薦紀錄查看

## 安裝
1. 將專案放到 Web Server，例如：`/opt/homebrew/var/www/dermcare_ai_v2`
2. 匯入資料庫：

```bash
mysql -u root -p < database.sql
```

3. 修改 `includes/config.php` 或設定環境變數：

```bash
export DB_HOST=127.0.0.1
export DB_NAME=dermcare_ai_v2
export DB_USER=root
export DB_PASS=你的密碼
export GROQ_API_KEY=你的GroqKey
```

## 預設帳號
- admin@example.com
- admin123

正式部署請立刻修改管理員密碼。

## 安全聲明
本系統只提供藥妝商品資訊與保養建議，不可取代醫師、藥師或皮膚科診斷。
