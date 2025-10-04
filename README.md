# Freemarket
## 環境構築
Dokerビルド
・git clone git@github.com:emru30/Freemarket.git
・docker-compose up -d --build
Laravel環境構築
・docker-compose exec php bash
・composer install
・cp .env.example .env
・php artisan key:generate
・php artisan migrate
・php artisan db:seed
## 使用技術（実行環境）
・PHP：8.2-fpm
・Laravel：8
・MySQL：8.0.26
・nginx：1.21.1
## ER図
<img width="693" height="991" alt="image" src="https://github.com/user-attachments/assets/eb082e8d-6576-406a-a3de-a575d30c24bb" />
## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/
