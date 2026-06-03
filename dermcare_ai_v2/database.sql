CREATE DATABASE IF NOT EXISTS dermcare_ai_v2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE dermcare_ai_v2;
DROP TABLE IF EXISTS favorites;
DROP TABLE IF EXISTS recommendation_logs;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;
CREATE TABLE users(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(80) NOT NULL,email VARCHAR(160) NOT NULL UNIQUE,password VARCHAR(255) NOT NULL,role ENUM('admin','member') DEFAULT 'member',skin_type VARCHAR(50),allergy_note TEXT,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE products(id INT AUTO_INCREMENT PRIMARY KEY,brand VARCHAR(80) NOT NULL,name VARCHAR(160) NOT NULL,category VARCHAR(50) NOT NULL,price INT NOT NULL,skin_types VARCHAR(160),concerns VARCHAR(160),ingredients TEXT,avoid_for TEXT,description TEXT,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE recommendation_logs(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NULL,skin_type VARCHAR(50),goal VARCHAR(80),budget INT,avoid_note TEXT,user_note TEXT,matched_products TEXT,ai_response MEDIUMTEXT,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL);
CREATE TABLE favorites(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,product_id INT NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,UNIQUE KEY uniq_fav(user_id,product_id),FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE);
INSERT INTO users(name,email,password,role,skin_type,allergy_note) VALUES('系統管理員','admin@example.com','$2y$10$y0ZV2XTEfLkpFQnRAK0YseRV/UY1f2ny9UUMb0MxeW6J7YwqcIYdS','admin','混合肌','');
INSERT INTO products(brand,name,category,price,skin_types,concerns,ingredients,avoid_for,description) VALUES
('DermaLab','胺基酸溫和潔顏乳','洗面乳',420,'敏感肌,乾性肌,混合肌','保濕,舒緩','胺基酸界面活性劑、甘油、積雪草','對椰油衍生成分過敏者先局部測試','主打低刺激清潔，適合日常早晚使用。'),
('AquaCare','神經醯胺修護乳','乳液',650,'乾性肌,敏感肌,普通肌','保濕,舒緩','神經醯胺、角鯊烷、玻尿酸','油痘肌初期少量使用','強化保濕與屏障修護，適合乾燥與泛紅族群。'),
('ClearSkin','水楊酸調理精華','精華液',780,'油性肌,混合肌','控油,痘痘','水楊酸、菸鹼醯胺、鋅 PCA','孕婦、酸類敏感者、皮膚破損者避免','協助角質調理與油脂管理，建議夜間低頻率使用。'),
('SunMed','清爽防曬乳 SPF50','防曬',520,'油性肌,混合肌,普通肌','防曬,控油','物理+化學防曬劑、維他命E','對防曬劑過敏者先測試','清爽型日用防曬，適合通勤與戶外短時間活動。'),
('CalmPlus','積雪草舒緩化妝水','化妝水',360,'敏感肌,普通肌,混合肌','舒緩,保濕','積雪草、泛醇、甘草酸鹽','對植物萃取過敏者先測試','用於清潔後補水舒緩，適合換季不穩定膚況。'),
('BrightOne','菸鹼醯胺亮白精華','精華液',720,'普通肌,混合肌,乾性肌','亮白,保濕','菸鹼醯胺、傳明酸、玻尿酸','對高濃度菸鹼醯胺不耐者減量','改善暗沉與膚色不均，需搭配防曬。'),
('AcneGuard','茶樹淨痘凝膠','痘痘護理',330,'油性肌,混合肌','痘痘,控油','茶樹、鋅 PCA、尿囊素','大面積敏感泛紅不建議厚敷','局部點擦型凝膠，適合偶發粉刺痘痘。'),
('HydraSoft','玻尿酸保濕精華','精華液',590,'乾性肌,敏感肌,普通肌','保濕','玻尿酸、甘油、泛醇','極油肌可減少用量','質地輕盈，主打補水與降低乾燥緊繃。');
