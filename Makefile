composer-install:
	docker-compose run --rm php php -d memory_limit=-1 /usr/bin/composer install

#Todo send auto yes
#make-migration:
#	docker-compose run --rm php bin/console make:migration

migrations-migrate:
	docker-compose run --rm php bin/console doctrine:migrations:migrate

migrate:
	docker-compose run --rm php php bin/console doctrine:migrations:migrate

cache-clear:
	docker-compose run --rm php php bin/console cache:clear

react-install:
	docker-compose run --rm react npm i

react-dev:
	docker-compose run --rm react npm run dev
