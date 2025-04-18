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

clean-all:
	docker system prune --all --force && docker system prune --all --force --volumes

## PHP bash
bash:
	docker compose exec fpm bash


## Nginx reload
reload-nginx:
	docker exec nginx-station nginx -s reload

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
	$(docker_compose_exec) fpm rm -rf var/cache/*
	$(docker_compose_exec) fpm mkdir -p var/cache/prod/tcpdf
	$(docker_compose_exec) fpm chown -R www-data:www-data var/cache
	$(docker_compose_exec) fpm chmod -R 775 var/cache
	$(php_console) cache:clear

logs-clear:
	$(docker_compose_exec) fpm rm -rf var/log/*

## Corriger les permissions
fix-perms:
	$(docker_compose_exec) fpm chown -R www-data:www-data var
	$(docker_compose_exec) fpm chmod -R 775 var

## Tout nettoyer (commande principale)
clean: fix-perms cache-clear
	@echo "✅ Cache complètement nettoyé et réchauffé"

## Aide (liste les commandes disponibles)
help:
	@echo "Commandes disponibles:"
	@echo "make clean      - Nettoie complètement le cache"
	@echo "make cache-clean - Supprime le cache sans réchauffement"
	@echo "make fix-perms  - Corrige les permissions"