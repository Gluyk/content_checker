composer-install:
	docker-compose run --rm php php -d memory_limit=-1 /usr/bin/composer install

migrations-migrate:
	docker-compose run --rm php php bin/console doctrine:migrations:migrate

cache-clear:
	docker-compose run --rm php php bin/console cache:clear