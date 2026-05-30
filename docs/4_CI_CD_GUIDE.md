# GitHub Actions CI/CD 部署指南

本指南說明如何設定 GitHub Actions，將程式碼自動部署到 Google Cloud Platform (GCP) 的虛擬機 (Compute Engine) 上。

## 1. 原理說明

我們使用 `appleboy/ssh-action` 這個工具，它的工作原理是：
1. 當您 Push 程式碼到 GitHub 的 `main` 分支時。
2. GitHub Action 會自動啟動。
3. 它會透過 SSH 連線到您的 GCP VM。
4. 在 VM 上執行 `git pull` 拉取最新程式碼。
5. 重新產生 `.env` 檔案 (確保密碼安全更新)。
6. 執行 `docker-compose up -d --build` 重啟服務。

---

## 2. GCP VM 準備工作 (只需做一次)

在您的 GCP VM 上，請執行以下操作：

1.  **安裝 Docker & Git**: 確保 VM 已安裝 Docker 和 Git。
2.  **Clone 專案**:
    ```bash
    # 假設我們要放在 /var/www/oat_docker
    sudo mkdir -p /var/www/oat_docker
    sudo chown $USER:$USER /var/www/oat_docker
    git clone https://github.com/<您的帳號>/<專案名稱>.git /var/www/oat_docker
    ```
    *(注意：如果是私有倉庫，您能在 VM 上設定 Deploy Key 或使用 https token 登入)*

---

## 3. GitHub Secrets 設定

為了讓 GitHub 能連線到 GCP 並寫入正確密碼，請到 GitHub 儲存庫的 **Settings** > **Secrets and variables** > **Actions** > **New repository secret**，新增以下變數：

### 連線資訊
| Secret 名稱 | 說明 | 範例 |
| :--- | :--- | :--- |
| `GCP_VM_HOST` | VM 的外部 IP 位址 | `34.80.x.x` |
| `GCP_VM_USER` | SSH 登入使用者名稱 | `sakiya` |
| `GCP_VM_SSH_KEY` | SSH 私鑰內容 (整串複製) | `-----BEGIN RSA PRIVATE KEY-----...` |

> **如何取得 SSH Key?**
> 您可以在本機建立一組專用 Key：`ssh-keygen -t rsa -b 4096 -f gcp_deploy_key`
> 然後將公鑰 (`.pub`) 內容新增到 GCP VM 的 `~/.ssh/authorized_keys` 中，私鑰內容則貼到這裡。

### 環境變數 (對應 .env)
| Secret 名稱 | 說明 |
| :--- | :--- |
| `DB_NAME` | 資料庫名稱 (例如 `juso1326_ota`) |
| `DB_USER` | 資料庫帳號 |
| `DB_PASSWORD` | 資料庫密碼 |
| `DB_ROOT_PASSWORD`| 資料庫 Root 密碼 |
| `GII_PASSWORD` | Gii 工具密碼 |
| `SMTP_HOST` | 郵件主機 |
| `SMTP_PORT` | 郵件 Port |
| `SMTP_USER` | 郵件帳號 |
| `SMTP_PASSWORD` | 郵件密碼 |

---

## 4. 測試部署

設定完成後，只要您將程式碼 Push 到 `main` 分支，GitHub Actions 就會自動開始部署流程。您可以到 GitHub 的 **Actions** 分頁查看執行進度與 Log。
