# GCP 虛擬主機 (VM) 資源評估報告

本報告針對您的專案特性 (Yii 1.1 + PHP 8.1 + Docker) 及其與其他專案共用主機的需求，提供資源規劃建議。

## 1. 專案資源需求分析

您的專案包含三個主要服務容器，以下是單一專案運作時的記憶體 (RAM) 推估：

| 服務容器 | 技術架構 | 預估記憶體 (低負載) | 預估記憶體 (尖峰/PDF生成) | 備註 |
| :--- | :--- | :--- | :--- | :--- |
| **oat_nginx** | Nginx | ~30 MB | ~50 MB | 用作 Proxy，資源消耗極低 |
| **oat_web** | PHP 8.1 / Apache | ~128 MB | ~512 MB+ | **這最吃資源**。每個 Apache 連線約佔 20-40MB，但 **PDF 生成 (TCPDF)** 處理大檔時會瞬間飆高記憶體。 |
| **oat_db** | MariaDB 10.11 | ~256 MB | ~1 GB | 資料庫需要 RAM 進行快取才能順暢，低於 512MB 容易 Crash。 |
| **總計** | | **約 500 MB** | **約 1.5 GB - 2 GB** | 還需加上 OS 本身約 300-500 MB |

## 2. 硬體規格建議 (VM Spec)

針對您「多專案共用主機」的需求，建議選擇 **E2 系列 (CP值最高)**。

### 方案 A：小型起步 (僅放此專案 + 1 個小型靜態站)
*   **機型**: `e2-small` (2 vCPUs, 2 GB RAM)
*   **適用情境**: 測試環境、流量極低。
*   **風險**: 當 PDF 生成或資料庫查詢變重時，**極高機率發生 OOM (Out Of Memory) 當機**。
*   **必須搭配**: 設定 2GB 以上的 Swap (虛擬記憶體)。

### 方案 B：標準推薦 (放此專案 + 2-3 個中小型專案)
*   **機型**: `e2-medium` (2 vCPUs, 4 GB RAM)
*   **適用情境**: 正式環境、多專案共存。
*   **優勢**: 有足夠的緩衝空間讓 MySQL 和 PHP 運作，不會因為單一專案瞬間飆高而拖垮整台機器。

### 方案 C：效能型 (大量多專案)
*   **機型**: `e2-standard-2` (2 vCPUs, 8 GB RAM)
*   **適用情境**: 如果您打算放 5 個以上動態網站 (PHP/Node.js/Python)。

---

## 3. 多專案共用之優化策略 (重要!)

要在同一台 VM 放多個專案，**絕對不能** 每個專案都開一套完整的 Docker (Nginx+PHP+DB)。這樣資源會被重複的 DB 和 Nginx 吃光。

### 最佳實踐架構
1.  **共用入口 (Global Proxy)**:
    *   整台機器只跑 **一個** Nginx (或 Traefik) 容器，負責聽 80/443 Port。
    *   依據網域名稱 (Domain) 將流量轉發給不同專案的 PHP 容器。
    
2.  **共用資料庫 (Global Database)**:
    *   整台機器只跑 **一個** MariaDB/MySQL 容器。
    *   在本機建立不同資料庫 (Create Database `project_a`, `project_b`...)。
    *   所有專案連線到同一個 DB 容器 (透過 Docker Network)。
    *   **優點**: 節省大量 RAM (從每個專案 500MB -> 共用 1GB)。

3.  **獨立運算 (Dedicated App Containers)**:
    *   每個專案只保留各自的 **PHP/Web 容器**。
    *   這樣能確保 PHP 版本隔離 (專案 A 用 PHP 7.4，專案 B 用 PHP 8.1)。

### 調整後的 Docker Compose 範例
若採用共用架構，您的專案 `docker-compose.yml` 會瘦身成這樣：
```yaml
version: '3'
services:
  web:
    image: my-project-image
    networks:
      - global_proxy_net # 加入共用網路
      - global_db_net
    environment:
      - DB_HOST=global_db_container # 連到共用 DB
```

## 4. 總結建議
1.  **機器規格**: 建議從 **`e2-medium` (4GB RAM)** 開始。
2.  **設定 Swap**: 務必在 Linux 系統啟用 **4GB Swap**，這是防止當機的最後防線。
3.  **架構調整**: 如果專案數量 > 2，強烈建議改用「共用 DB」架構。
