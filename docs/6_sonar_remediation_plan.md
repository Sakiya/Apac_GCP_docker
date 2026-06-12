# SonarQube 程式碼品質修復與優化建議

本文件針對 Apac GCP Docker 專案在 SonarQube 掃描中發現的 **5,932 個 Issues** 進行評估，並提供具體的修復優先順序與執行方案。

---

## 一、 Issue 統計總覽

* **總數**：5,932 個 Issue
* **三大指標評級**：
  * **安全性 (Security)**：C 級 (1 個 Vulnerability, 30 個 Security Hotspots)
  * **可靠性 (Reliability)**：D 級 (407 個 Bugs)
  * **維護性 (Maintainability)**：A 級 (約 5,500 個 Code Smells)

---

## 二、 核心策略：Clean as You Code (新增代碼把關)

由於歷史程式碼 (Legacy Code) 累積的 Code Smell (如：舊版 `var` 宣告、無意義註解等) 高達 5,500 個以上，**強烈不建議進行全面手動修改**。這會造成：
1. **極高風險**：在沒有單元測試覆蓋的情況下重構舊程式，極易引發線上 regressions (功能損壞)。
2. **效益極低**：修正排版與變數命名並不會提升運作效能。

### 建議做法：
1. **CI/CD 品質門檻調整**：
   * 在 SonarQube 設定中，將「新程式碼 (New Code)」定義為 `Previous version` (前一版本) 或 `Specific analysis` (指定分析)。
   * 如此一來，CI/CD 的 Gate 只會針對「本次 PR/Commit 新增的部分」進行阻斷，確保不寫入新的垃圾代碼即可。
2. **手動分級修復**：僅針對以下「高風險安全性漏洞」與「會引發執行期錯誤的 Bug」進行修正。

---

## 三、 建議優先修復清單

以下為從 `sonar_bugs.json` 篩選出目前處於 `OPEN` 狀態且最具修復價值的項目：

### 1. 【安全性】1 個重大安全性漏洞 (Vulnerability)
* **位置**：`www/protected/models/Yearm1.php`
* **問題訊息**：`Make sure this permission is safe.`
* **修復建議**：
  * 檢查該 Model 是否有使用類似 `chmod`、`chown` 或不安全的檔案存取權限設定。
  * 限制檔案上傳或寫入權限（例如最大僅開放 `0644` 或 `0755` 權限），避免系統被惡意寫入 Webshell。

### 2. 【可靠性】嚴重 Bug (Major/Critical Bugs)
本專案有 349 個 Major 以上的 Bugs，大部分集中在後端 Controller 中。

#### ⚠️ 類型 A：未宣告/未初始化變數即使用 (Uninitialized Value)
* **典型位置**：
  * `www/protected/controllers/FillController.php` (Line 507, 691 等多處)
  * `www/protected/controllers/PostController.php` (Line 50)
* **原因**：在 PHP 中直接讀取未被宣告定義的變數。
* **影響**：在 PHP 8+ 版本中會觸發 `Warning: Undefined variable`，在嚴格模式或特定環境下會直接導致 500 錯誤。
* **修復建議**：
  ```php
  // 修正前
  $result = $undefinedVar + 10;
  
  // 修正後
  $undefinedVar = isset($undefinedVar) ? $undefinedVar : 0; // 或賦予預設值
  $result = $undefinedVar + 10;
  ```

#### ⚠️ 類型 B：JS 物件重複的屬性名稱 (Duplicate Property Name)
* **典型位置**：
  * `www/main/js/trigger/kl-recent-work-carousel.js` (Line 20)
* **原因**：在 JS 物件定義中，重複寫了兩次同名的 Key（例如重複設定 `scroll: true`）。
* **影響**：後面的設定會無預警覆蓋前者，可能導致輪播套件無法正常滾動或點擊。
* **修復建議**：檢查並刪除重複的屬性設定，僅保留正確的值。

#### ⚠️ 類型 C：無效的自我賦值 (Useless Self-Assignment)
* **典型位置**：
  * `www/protected/controllers/FillController.php` (Line 655)
* **原因**：程式中寫了 `$var = $var;` 這種自己等於自己的代碼。
* **影響**：通常是打錯字（例如本來要寫 `$this->var = $var` 或寫入資料庫欄位），代表有漏寫的業務邏輯。
* **修復建議**：確認該變數原始要賦值的對象，並予以修正。

---

## 四、 本地維護輔助工具

專案根目錄下已建立 [fetch_sonar_issues.py](file:///Users/sakiya/Documents/Web.nosync/Apac_GCP_docker/fetch_sonar_issues.py) 工具。
未來若有需要更新本地的 [sonar_bugs.json](file:///Users/sakiya/Documents/Web.nosync/Apac_GCP_docker/sonar_bugs.json) 報告，可於終端機執行：

```bash
python3 fetch_sonar_issues.py $SONAR_TOKEN
```
*(本腳本會自動以分頁方式安全下載所有 5,000+ 筆完整 Issues 報告)*
