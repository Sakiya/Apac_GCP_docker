# OAT Docker Project

![PHP](https://img.shields.io/badge/PHP-8.1-777BB4?style=flat-square&logo=php&logoColor=white)
![Yii](https://img.shields.io/badge/Framework-Yii%201.1-D9534F?style=flat-square&logo=yii&logoColor=white)
![Nginx](https://img.shields.io/badge/Server-Nginx-009639?style=flat-square&logo=nginx&logoColor=white)
![MariaDB](https://img.shields.io/badge/Database-MariaDB%2010.11-003545?style=flat-square&logo=mariadb&logoColor=white)
![Docker](https://img.shields.io/badge/Container-Docker-2496ED?style=flat-square&logo=docker&logoColor=white)

本專案致力於將 OAT 舊版網站系統 (基於 Yii 1.1 + PHP 8.1) 進行現代化容器封裝。透過 Docker 部署，我們建立了一套包含 **Nginx 反向代理**、**MariaDB 資料庫** 以及 **多層次資安防護** 的穩定運行環境。

---

## 🏗️ 系統架構 (Architecture)

本專案採用微服務架構，各服務職責分離，提升安全性與可維護性。

```mermaid
graph TD
    User((User)) -->|HTTPS/80| Cloudflare
    Cloudflare -->|HTTP/80| Nginx[Nginx Gateway<br/>(oat_nginx)]
    
    subgraph Docker Network [oat-network]
        Nginx -->|Proxy| Web[Web App<br/>(oat_web)]
        Web -->|TCP/3306| DB[(MariaDB Database<br/>(oat_db))]
        Portainer[Portainer Monitor<br/>(portainer)] -.->|Docker Sock| DockerDaemon
    end

    User -.->|HTTP/Monitor| Nginx
    Nginx -.->|Proxy| Portainer

    style Nginx fill:#009639,stroke:#333,stroke-width:2px,color:white
    style Web fill:#777BB4,stroke:#333,stroke-width:2px,color:white
    style DB fill:#003545,stroke:#333,stroke-width:2px,color:white
    style Portainer fill:#2496ED,stroke:#333,stroke-width:2px,color:white
```

### 服務組件說明

| 服務名稱 | 容器名稱 | 角色 | 端口設定 |說明 |
| :--- | :--- | :--- | :--- | :--- |
| **Nginx** | `oat_nginx` | Gateway | **對外: 80** | 負責流量入口、資安標頭、反向代理。 |
| **Web App** | `oat_web` | Backend | 對內: 80 | 運行 Apache + PHP 8.1 + Yii 1.1。**不對外暴露**。 |
| **Database**| `oat_db` | Database | **對外: 3307** | MariaDB 10.11 LTS。映射至 Host 3307 以避開本機衝突。 |
| **Monitoring**| `portainer`| Monitor | 對內: 9000 | 透過 Nginx 轉發，無需對外開放 Port。 |

---

## 🚀 快速開始 (Quick Start)

### 1. 前置需求 (Prerequisites)
確保您的伺服器已安裝：
*   [Docker](https://docs.docker.com/get-docker/)
*   [Docker Compose](https://docs.docker.com/compose/install/)

### 2. 設定環境變數
系統敏感資訊（如密碼）皆透過 `.env` 管理。請複製範本並填入您的設定：

```bash
# 複製範本
cp .env.example .env

# 編輯設定 (設定資料庫密碼、SMTP 等)
vim .env
```
> [!IMPORTANT]
> `.env` 檔案包含機敏資訊，**請勿** 提交至版本控制系統 (Git)。

### 3. 啟動服務
執行以下指令一鍵啟動所有服務：

```bash
docker-compose up -d --build
```

### 4. 初始化資料庫
首次啟動時，MariaDB 容器會自動執行 `juso1326_ota.sql` 進行資料庫初始化。
*   若需 **重新初始化** (清除所有資料)，請參閱下方 [維護指令](#-維護指令-maintenance-commands)。

---

## ⚙️ 重要設定 (Configuration)

### 網域與 Nginx 設定
修改 `nginx/default.conf` 來設定您的 **PRD (正式環境)** 網域：

```nginx
server {
    listen 80;
    # 修改 server_name 為您的網域
    server_name registration.onearttaipei.com localhost; 
    ...
}
```

### 系統監控 (Portainer)
本專案整合了 Portainer 進行容器監控。

1.  **啟動監控服務**:
    ```bash
    docker-compose -f docker-compose.monitor.yml up -d
    ```
2.  **訪問位置**: `http://monitor.onearttaipei.com` (需配合 Nginx 與 DNS 設定)
3.  **注意**: 監控堆疊依賴主專案的網路 `oat_docker_oat-network`。請確保主服務已啟動。

---

## 🛡️ 資安防護機制 (Security)

本環境針對常見 Web 攻擊實作了多層防禦：

1.  **隱蔽性 (Obscurity)**: 隱藏 Nginx, Apache, PHP 版本資訊，減少被掃描特徵。
2.  **HTTP Headers 防護**:
    *   `Content-Security-Policy`: 限制資源載入來源。
    *   `X-Frame-Options`: 防止點擊劫持 (Clickjacking)。
    *   `X-XSS-Protection`: 阻擋 XSS 攻擊。
3.  **PHP 安全強化**: 透過 `security.ini` 關閉錯誤顯示、強化 Session Cookie (`HttpOnly`, `SameSite`)。
4.  **Gii 代碼生成器防護**: 僅在 `YII_DEBUG=true` 且驗證密碼後才可啟用 (僅限 DEV 環境使用)。
5.  **網路隔離**: Web 容器與 Portainer 皆不對外暴露 Port，僅透過 Nginx 代理訪問。

---

## 🛠️ 維護指令 (Maintenance Commands)

### ⚡ 懶人包 (Recommended)
本專案提供統一的管理腳本，整合了所有常用功能。

**1. 賦予執行權限** (僅需執行一次):
```bash
chmod +x manage.sh manage.command
```

**2. 執行方式**:

*   **Mac 使用者**:
    *   雙擊 `manage.command` 檔案即可執行。
    *   或在終端機輸入: `./manage.command`
*   **Linux 使用者**:
    *   直接執行: `./manage.sh`

---

### 手動操作指令 (Manual Commands)

若您偏好手動輸入指令，可參考以下列表：

**常用操作**


| 動作 | 指令 |
| :--- | :--- |
| **重啟所有服務** | `docker-compose restart` |
| **查看 Nginx Log** | `tail -f logs/nginx/error.log` |
| **查看 PHP Error** | `tail -f logs/apache/error.log` |
| **進入 Web 容器** | `docker exec -it oat_web bash` |

### 清除快取 (Cache Setup)
若修改程式或設定後畫面未更新，可嘗試清除 Yii 快取：

```bash
# 清除 Assets (前端資源)
rm -rf www/assets/* && touch www/assets/.gitkeep

# 清除 Runtime (Log/Session/Cache)
rm -rf www/protected/runtime/* && touch www/protected/runtime/.gitkeep
```

### 資料備份與清理 (Data Management)

**1. 快速打包下載 Uploads (Backup)**
執行以下指令將 `uploads` 資料夾壓縮為 `.tar.gz` 檔，方便下載或備份：

```bash
# 格式: tar -zcvf [壓縮檔名] [目標資料夾]
tar -zcvf uploads_backup_$(date +%Y%m%d).tar.gz ./uploads
```
執行後，目錄下方會出現 `uploads_backup_YYYYMMDD.tar.gz`，您可以使用 sftp 或其他工具下載此檔案。

**2. 清除 Uploads 所有檔案 (Cleanup)**
⚠️ **危險操作：此動作會永久刪除所有使用者上傳的圖片！**
若您需要清空 **DEV (測試環境)** 資料，請執行：

```bash
# 刪除 uploads 下的所有檔案與資料夾，但保留 uploads 資料夾本身
rm -rf ./uploads/*
```

### 重置環境 (Reset)
⚠️ **警告：此操作將刪除資料庫內所有資料！**

```bash
# 停止並刪除容器與 Volume
docker-compose down -v

# 重新建置並啟動
docker-compose up -d --build
```

---

## 📂 資料夾結構 (Directory Structure)

```text
.
├── .env                 # [機密] 環境變數設定
├── docker-compose.yml   # 主服務架構定義
├── docker-compose.monitor.yml # 監控服務定義
├── Dockerfile           # Web 容器建置檔
├── security.ini         # PHP 安全設定覆蓋
├── juso1326_ota.sql     # 資料庫初始化 SQL
├── nginx/               # Nginx 設定檔
├── www/                 # 網站原始碼 (Source Code)
├── logs/                # [自動產生] 服務 Logs
└── uploads/             # [持久化] 使用者上傳檔案 (需備份)
```

> [!TIP]
> **備份建議**: 請定期備份 `uploads/` 資料夾以及資料庫內容，以防止重要資料遺失。
