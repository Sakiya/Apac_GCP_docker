# 使用官方 PHP 8.1 搭配 Apache 的映像檔
FROM php:8.1-apache

# [安裝依賴] 更新套件列表並安裝必要的系統工具與函式庫
# libpng, libjpeg, libfreetype 用於圖片處理 (GD 庫)
# zip, unzip, git 用於 Composer 與程式碼管理
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# [安裝 PHP 擴充]
# gd: 圖片處理
# pdo_mysql, mysqli: MySQL 資料庫連接
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql mysqli

# [設定 Apache] 啟用 mod_rewrite 模組 (Yii 框架網址重寫需要)
RUN a2enmod rewrite

# 設定工作目錄
WORKDIR /var/www/html

# [設定 Apache DocumentRoot]
# 將網站根目錄指向 /var/www/html/www (因為您的 index.php 在 www 子目錄下)
ENV APACHE_DOCUMENT_ROOT /var/www/html/www
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# [資安] 複製自訂的 PHP 安全設定 (隱藏版本、強制安全 Session 等)
COPY security.ini /usr/local/etc/php/conf.d/security.ini

# [資安] 隱藏 Apache 版本資訊
# ServerTokens Prod: 只顯示 "Apache" 字樣，不顯示版本號
# ServerSignature Off: 關閉錯誤頁面上的伺服器簽名
RUN echo "ServerTokens Prod" >> /etc/apache2/apache2.conf && \
    echo "ServerSignature Off" >> /etc/apache2/apache2.conf

# 宣告容器會使用 Port 80
EXPOSE 80
