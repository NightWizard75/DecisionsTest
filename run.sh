./start_copy.sh
docker-compose up -d
dockerID=$(docker ps -aq --filter "name=workspace")
docker exec $dockerID bash -c "cd /srv/scripts/ && php start.php && ./start.sh"

