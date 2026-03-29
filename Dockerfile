FROM php:8.1-apache
# คำสั่งติดตั้ง Extension เพื่อให้ PHP คุยกับ MySQL รู้เรื่อง (PDO)
RUN docker-php-ext-install mysqli pdo pdo_mysql