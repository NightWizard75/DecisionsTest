@echo off
call start_copy.bat
docker-compose up -d
for /F "delims=xxx" %%a in ('docker ps -aq --filter "name=workspace"') do set docker=%%a
docker exec %docker% bash -c "cd /srv/scripts/ && php start.php && ./start.sh"
