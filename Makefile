#########
# Utils #
#########

start-all:
	(cd infra-services && make start) && (cd lobievents && make start) && (cd resume && make start) && (cd expense-report && make start) && (cd fere && make start) && (cd partners && make start) && (cd station && make start)

stop-all:
	(cd infra-services && make stop) && (cd lobievents && make stop) && (cd resume && make stop) && (cd expense-report && make stop) && (cd fere && make stop) && (cd partners && make stop) && (cd station && make stop)


restart-all:
	(cd infra-services && make restart) && (cd lobievents && make restart) && (cd resume && make restart) && (cd expense-report && make restart) && (cd fere && make restart) && (cd partners && make restart) && (cd station && make restart)

start-infra-services:
	(cd infra-services && make start)

stop-infra-services:
	(cd infra-services && make stop) && docker ps

cache-clean-all:
	(cd lobievents && make cache-clear) && (cd expense-report && make cache-clear) && (cd fere && make cache-clear) && (cd partners && make cache-clear) && (cd station && make cache-clear)

docker-clean:
	docker system prune --all --force && docker system prune --all --force --volumes

## PHP bash
bash-resume:
	cd resume && make bash

bash-lobievents:
	cd lobievents && make bash

bash-expense-report:
	cd expense-report && make bash

bash-fere:
	cd fere && make bash

bash-partners:
	cd partners && make bash

bash-station:
	cd station && make bash
