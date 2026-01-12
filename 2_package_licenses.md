# 專案套件授權及版本清單 (Project Packages, Licenses, and Versions)

以下列出專案中偵測到的主要套件、其版本、授權條款及來源網址。

## 1. PHP 框架與核心元件 (PHP Framework & Core)

| 套件名稱 (Package Name) | 版本 (Version) | 授權 (License) | 來源網址 (Source URL) | 備註 |
| :--- | :--- | :--- | :--- | :--- |
| **Yii Framework** | 1.1.33-dev | BSD-3-Clause | [https://github.com/yiisoft/yii](https://github.com/yiisoft/yii) | 位於 `yii` 目錄 |

## 2. 應用程式擴充套件 (Application Extensions)

位於 `www/protected/extensions/` 目錄下的第三方套件。

| 套件名稱 (Package Name) | 版本 (Version) | 授權 (License) | 來源網址 (Source URL) | 檔案路徑/備註 |
| :--- | :--- | :--- | :--- | :--- |
| **PHPMailer** | 5.1 | LGPL | [http://phpmailer.sourceforge.net](http://phpmailer.sourceforge.net) / [GitHub](https://github.com/PHPMailer/PHPMailer) | `extensions/phpmailer` |
| **PHPMailer** (SMTP Mail) | 5.2.4 | LGPL | [https://code.google.com/a/apache-extras.org/p/phpmailer/](https://code.google.com/a/apache-extras.org/p/phpmailer/) | `extensions/smtpmail` (包含較新版 PHPMailer) |
| **HTML2PDF** | 4.4.0 | LGPL | [http://html2pdf.fr](http://html2pdf.fr) / [GitHub](https://github.com/spipu/html2pdf) | `extensions/tcpdf` (內含 TCPDF 5.0.002) |
| **TCPDF** | 5.0.002 | LGPL | [https://tcpdf.org/](https://tcpdf.org/) | 包裝於 HTML2PDF 內 |
| **ETinyMce** | 4.0.19 (TinyMCE) | LGPL | [http://www.tinymce.com](http://www.tinymce.com) | `extensions/tinymce_e` (TinyMCE Wrapper) |
| **YiiMail** | Unknown (Wraps SwiftMailer) | New BSD (Probable) | [https://code.google.com/p/yii-mail/](https://code.google.com/p/yii-mail/) | `extensions/yii-mail` |
| **SwiftMailer** | Unknown | LGPL | [https://swiftmailer.symfony.com/](https://swiftmailer.symfony.com/) | 位於 `yii-mail/vendors` |
| **CJuiDateTimePicker** | Unknown | BSD/MIT (Implied) | [Yii Extensions](https://www.yiiframework.com/extension/juidatetimepicker) | `extensions/CJuiDateTimePicker`. Wraps jQuery Timepicker. |
| **php-export-data** | Unknown | MIT | [http://github.com/elidickinson/php-export-data](http://github.com/elidickinson/php-export-data) | `extensions/ExportDataExcel.php` |

## 3. 系統與環境套件 (System & Environment Packages)

基於 `Dockerfile` (php:8.1-apache) 所安裝的系統套件。

| 套件名稱 (Package Name) | 類型 (Type) | 說明 (Description) |
| :--- | :--- | :--- |
| **php:8.1-apache** | Docker Image | PHP 8.1 官方映像檔 (Debian Base) |
| **libpng-dev** | Library | PNG 圖片處理庫 (Development files) |
| **libjpeg-dev** | Library | JPEG 圖片處理庫 (Development files) |
| **libfreetype6-dev** | Library | 字型處理庫 (FreeType) |
| **zip / unzip** | Tool | 壓縮/解壓縮工具 |
| **git** | Tool | 版本控制工具 |
| **ext-gd** | PHP Extension | 圖片處理擴充 (GD Graphics Library) |
| **ext-pdo_mysql** | PHP Extension | MySQL 資料庫連接驅動 |
| **ext-mysqli** | PHP Extension | MySQL 改進版連接介面 |

---
**注意**:
1. 版本號碼取自程式碼標頭或定義檔，若無明確標示則標註為 Unknown。
2. `www/protected/extensions/` 目錄下可能包含多個版本的同一函式庫 (如 PHPMailer)，已分別列出。
3. `Yii Framework` 版本為 `1.1.33-dev`，這是一個開發中的版本分支。
