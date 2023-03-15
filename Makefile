#!/usr/bin/make

SHELL = /bin/sh

fresh-serve: build run init-app info # init new serve app
serve: build run info # serve existing app

build: # build db, web and app container
	docker-compose build

run: # run existing containers
	docker-compose up -d

init-app: init-composer init-laravel refresh-db # init laravel-app in app container

init-composer: # init storage link in app container
	docker-compose exec cards-php composer install --ignore-platform-reqs

refresh-db: # init storage link in app container
	docker-compose exec cards-php php artisan db:wipe
	docker-compose exec cards-php php artisan migrate:refresh
	docker-compose exec cards-php php artisan db:seed

init-laravel: # init storage link in app container
	docker-compose exec cards-php php artisan key:generate
	docker-compose exec cards-php php artisan storage:link

migrate-db: # run migrations in app container
	docker-compose exec cards-php php artisan migrate

info: # information about containers
	docker-compose ps

down: # stop all containers
	docker-compose down

app-connect: # enter in laravel container
	docker exec -it cards-php /bin/ash

testing: # run tests
	docker-compose exec cards-php php ./vendor/bin/phpunit -d memory_limit=-1

testing-stop-on-failure: # run tests that stop on the first failure
	docker-compose exec cards-php php ./vendor/bin/phpunit --stop-on-failure -d memory_limit=-1

testing-dox: # run tests with nice output
	docker-compose exec cards-php php ./vendor/bin/phpunit -d memory_limit=-1 --testdox

testing-artisan: # run tests from artisan
	docker-compose exec cards-php php artisan test -d memory_limit=-1
