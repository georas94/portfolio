docker_compose_exec = docker compose exec -T
php_console = $(docker_compose_exec) fpm bin/console
symfony_console = $(docker_compose_exec) bash symfony

###############
# Application #
###############

controller:
	$(php_console) make:controller

entity:
	$(php_console) make:entity

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
	docker compose exec fpm bash

############
# Database #
############

## Create migration diff
db-drop:
	$(php_console) doctrine:database:drop --force --if-exists

db-create:
	$(php_console) doctrine:database:create --if-not-exists

db-schema:
	$(php_console) doctrine:schema:create

migrations-apply:
	$(php_console) doctrine:migrations:migrate -n

migrations-make:
	$(php_console) make:migration

fixtures: db-drop db-create db-schema
	$(php_console) doctrine:fixtures:load -n

## Clear cache
cc: cache-clear

cache-clear:
	$(php_console) cache:clear
