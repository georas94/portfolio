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

user:
	$(php_console) make:user

registration-form:
	$(php_console) make:registration-form

login-form:
	$(php_console) make:controller Login

workflow-dump-expense-report-svg:
	$(php_console) workflow:dump expense | dot -Tsvg -o graph.svg

workflow-dump-expense-report-png:
	$(php_console) workflow:dump expense | dot -Tpng -o graph.png

############
# Database #
############

## Reset database
db-schema:
	$(php_console) doctrine:schema:create

## Reset database by migrations
db-restore-by-migrations: db-drop db-create migrations-make migrations-apply

## Create migration diff
db-drop:
	$(php_console) doctrine:database:drop --force --if-exists

db-create:
	$(php_console) doctrine:database:create --if-not-exists

migrations-apply:
	$(php_console) doctrine:migrations:migrate -n

migrations-make:
	$(php_console) make:migration

fixtures: db-drop db-create db-schema
	$(php_console) doctrine:fixtures:load -n

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

composer:
	$(docker_compose_exec) php composer install --no-interaction

cache-clear:
	$(php_console) cache:clear

## Clear cache
cc: cache-clear

## PHP bash
bash:
	docker-compose exec php bash

## Follow containers logs
log:
	docker-compose logs -f
