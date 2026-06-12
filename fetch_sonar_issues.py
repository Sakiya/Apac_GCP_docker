import subprocess
import json
import sys
import urllib.parse

SONAR_URL = "https://sonar.3wcreative.com.tw"
PROJECT_KEY = "Sakiya_Apac_GCP_docker_6f1b1d51-49ed-4e0b-9db1-cd4cec0c2add"

def fetch_all_issues(token):
    all_issues = []
    page = 1
    page_size = 500
    total = 0
    
    print("開始從 SonarQube 獲取 Issues (透過系統 curl)...")
    while True:
        # 使用 urlencode 來建構 query parameters
        params = {
            "componentKeys": PROJECT_KEY,
            "ps": str(page_size),
            "p": str(page)
        }
        query_string = urllib.parse.urlencode(params)
        url = f"{SONAR_URL}/api/issues/search?{query_string}"
        
        # 呼叫系統的 curl 來避開 Python SSL TLS 版本相容性問題
        cmd = [
            "curl",
            "-s",
            "-u", f"{token}:",
            url
        ]
        
        try:
            result_process = subprocess.run(cmd, capture_output=True, text=True, check=True)
            data = json.loads(result_process.stdout)
            
            total = data.get("total", 0)
            issues = data.get("issues", [])
            if not issues:
                break
                
            all_issues.extend(issues)
            print(f"已獲取第 {page} 頁 ({len(issues)} 個 Issue)。進度：{len(all_issues)}/{total}")
            
            if len(all_issues) >= total:
                break
            page += 1
        except subprocess.CalledProcessError as e:
            print(f"執行 curl 失敗：{e}")
            break
        except json.JSONDecodeError as e:
            print(f"JSON 解析失敗：{e}")
            break
        
    result = {
        "total": total,
        "issues": all_issues
    }
    
    with open("sonar_bugs.json", "w", encoding="utf-8") as f:
        json.dump(result, f, ensure_ascii=False, indent=2)
    print(f"成功將 {len(all_issues)} 個 Issues 完整載入並儲存至 sonar_bugs.json！")

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("請提供您的 SonarQube Token！")
        print("使用方式：python3 fetch_sonar_issues.py <YOUR_SONAR_TOKEN>")
        sys.exit(1)
    fetch_all_issues(sys.argv[1])
