#!/bin/bash

# [Fix] 切換到腳本所在的目錄，確保雙擊執行時路徑正確
cd "$(dirname "$0")"

# 定義顏色
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[0;33m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

function show_menu() {
    clear
    echo -e "${CYAN}=== OAT Docker 管理工具 ===${NC}"
    echo "1. 🚀 啟動所有服務 (Start)"
    echo "2. 🛑 停止所有服務 (Stop)"
    echo "3. 🔄 重啟所有服務 (Restart)"
    echo "4. 🧹 清除快取 (Clear Cache)"
    echo "5. 📦 備份上傳資料 (Backup Uploads)"
    echo "6. 🗑️ 清空上傳資料 (Clean Uploads - DEV ONLY)"
    echo "7. 📄 查看 Logs (View Logs)"
    echo "8. 🐚 進入 Web 容器 Shell (Enter Container)"
    echo "0. 離開 (Exit)"
    echo -e "${CYAN}==========================${NC}"
}

function start_services() {
    echo -e "${GREEN}正在啟動服務...${NC}"
    # 確保 docker-compose 在 PATH 中 (針對某些 GUI 環境)
    export PATH=$PATH:/usr/local/bin
    docker-compose up -d --build
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}服務已啟動！${NC}"
    else
        echo -e "${RED}啟動失敗，請檢查 Docker 是否已開啟。${NC}"
    fi
}

function stop_services() {
    echo -e "${YELLOW}正在停止服務...${NC}"
    export PATH=$PATH:/usr/local/bin
    docker-compose down
    echo -e "${GREEN}服務已停止。${NC}"
}

function clear_cache() {
    echo -e "${YELLOW}正在清除 Yii Assets 與 Runtime 快取...${NC}"
    rm -rf www/assets/* && touch www/assets/.gitkeep
    rm -rf www/protected/runtime/* && touch www/protected/runtime/.gitkeep
    echo -e "${GREEN}快取已清除！${NC}"
}

function backup_uploads() {
    FILENAME="uploads_backup_$(date +%Y%m%d_%H%M%S).tar.gz"
    echo -e "${GREEN}正在備份 uploads 資料夾至 ${FILENAME}...${NC}"
    tar -zcvf "$FILENAME" ./uploads
    echo -e "${GREEN}備份完成: $FILENAME${NC}"
}

function clean_uploads() {
    echo -e "${RED}⚠️  警告：這將刪除 uploads 資料夾下的所有檔案！${NC}"
    read -p "您確定要繼續嗎？請輸入 'yes' 確認: " confirm
    if [[ "$confirm" == "yes" ]]; then
        rm -rf ./uploads/*
        echo -e "${GREEN}Uploads 資料夾已清空。${NC}"
    else
        echo "操作已取消。"
    fi
}

function view_logs() {
    echo "選擇要查看的 Log:"
    echo "1. Nginx"
    echo "2. Apache/PHP"
    echo "3. MariaDB"
    read -p "請選擇 [1-3]: " log_choice
    case $log_choice in
        1) tail -f logs/nginx/error.log ;;
        2) tail -f logs/apache/error.log ;;
        3) tail -f logs/mysql/error.log ;;
        *) echo "無效的選擇" ;;
    esac
}

function enter_shell() {
    echo -e "${GREEN}正在進入 oat_web 容器... (輸入 exit 離開)${NC}"
    docker exec -it oat_web bash
}

# 若有帶參數，直接執行對應功能
case "$1" in
    start)
        start_services
        ;;
    stop)
        stop_services
        ;;
    restart)
        stop_services
        start_services
        ;;
    cache-clear)
        clear_cache
        ;;
    backup)
        backup_uploads
        ;;
    *)
        # 互動模式
        while true; do
            show_menu
            read -p "請選擇操作 [0-8]: " choice
            case $choice in
                1) start_services ;;
                2) stop_services ;;
                3) stop_services; start_services ;;
                4) clear_cache ;;
                5) backup_uploads ;;
                6) clean_uploads ;;
                7) view_logs ;;
                8) enter_shell ;;
                0) echo "再見！"; exit 0 ;;
                *) echo -e "${RED}無效的選擇，請重試。${NC}" ;;
            esac
            echo ""
            read -p "按 Enter 鍵繼續..."
        done
        ;;
esac
