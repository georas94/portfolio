#########
# Utils #
#########

start-all:
	(cd infra-services && make start) && (cd lobievents && make start) && (cd resume && make start) && (cd expense-report && make start) && (cd youtube-downloader && make start)

stop-all:
	(cd infra-services && make stop) && (cd lobievents && make stop) && (cd resume && make stop) && (cd expense-report && make stop) && (cd youtube-downloader && make stop)


restart-all:
	(cd infra-services && make restart) && (cd lobievents && make restart) && (cd resume && make restart) && (cd expense-report && make restart) && (cd youtube-downloader && make restart)

docker-clean:
	docker system prune --all --force && docker system prune --all --force --volumes

## PHP bash
bash-resume:
	cd resume && make bash

bash-lobievents:
	cd lobievents && make bash

bash-expense-report:
	cd expense-report && make bash
