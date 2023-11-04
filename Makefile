#########
# Utils #
#########

start-all:
	(cd infra-services && make start) && (cd lobievents && make start) && (cd resume && make start)

stop-all:
	(cd infra-services && make stop) && (cd lobievents && make stop) && (cd resume && make stop)


restart-all:
	(cd infra-services && make restart) && (cd lobievents && make restart) && (cd resume && make restart)

docker-clean:
	docker system prune --all --force && docker system prune --all --force --volumes

## PHP bash
bash-resume:
	cd resume && make bash

bash-lobievents:
	cd lobievents && make bash
