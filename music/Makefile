#########
# Utils #
#########

start:
	docker compose up -d --remove-orphans

stop:
	docker compose down

restart:
	docker compose down && docker compose up -d --remove-orphans

docker-clean:
	docker system prune --all --force && docker system prune --all --force --volumes

## PHP bash
bash:
	docker compose exec php bash
