UID := $(shell id -u)
GID := $(shell id -g)
USER := $(UID):$(GID)
dc := user=$(USER) docker-compose

.PHONY: test
test:
	make init

.PHONY: init
init:
	$(dc) -f ./docker/docker-compose.yml up -d --build && \
	bash ./docker/php/php.sh
	$(dc) -f ./docker/docker-compose.yml exec php /bin/bash -c "composer install" && \
	$(dc) -f ./docker/docker-compose.yml exec php /bin/bash -c "cp .env.example .env" && \
	$(dc) -f ./docker/docker-compose.yml exec php /bin/bash -c "php artisan key:generate" && \
	$(dc) -f ./docker/docker-compose.yml exec php /bin/bash -c "php artisan migrate"

.PHONY: seed
seed:
	$(dc) -f ./docker/docker-compose.yml exec php php artisan db:seed

.PHONY: up
up:
	$(dc) -f ./docker/docker-compose.yml up -d --build

.PHONY: down
down:
	$(dc) -f ./docker/docker-compose.yml down

.PHONY: rm
rm:
	$(dc) -f ./docker/docker-compose.yml down --rmi all

.PHONY: logs
logs:
	$(dc) -f ./docker/docker-compose.yml logs -f

.PHONY: shPHP
shPHP:
	$(dc) -f ./docker/docker-compose.yml exec php /bin/bash

.PHONY: shDB
shDB:
	$(dc) -f ./docker/docker-compose.yml exec db /bin/bash

.PHONY: d-rm
d-rm:
	docker stop `docker ps -aq` ;\
	docker rm `docker ps -aq` ; \
	docker rmi `docker images -q`