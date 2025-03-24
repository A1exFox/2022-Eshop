include .env

ARG ?=

COMPOSE = docker compose
PHP_EXEC = docker exec php-fpm
COMPOSER = $(PHP_EXEC) composer

help:
	@echo "Compose commands:"
	@echo "  up             - Up compose"
	@echo "  build          - Build compose"
	@echo "  down           - Down compose"
	@echo ""
	@echo "Common commands:"
	@echo "  remove         - Remove all containers"
	@echo "  bash           - Start interactive mode"
	@echo "  test           - Run tests"
	@echo "  query          - Set query argument"
	@echo ""
	@echo "Mysql commands:"
	@echo "  dump           - Dump database"
	@echo ""
	@echo "Composer commands:"
	@echo "  cinit          - Init 'composer.json'"
	@echo "  cinstall       - Install packages"
	@echo "  cupdate        - Update packages"
	@echo "  cautoload      - Update autoload"
	@echo "  crequire       - Install package"
	@echo "  cremove        - Remove package"
	@echo ""


# Compose commands:
up:
	@$(COMPOSE) down
	@$(COMPOSE) up -d

build:
	@$(COMPOSE) down
	@$(COMPOSE) build

down:
	@$(COMPOSE) down


# Common commands:
remove:
	@echo "Stopping:"
	@docker stop nginx adminer php-fpm mysql
	@echo ""
	@echo "Removing:"
	@docker rm nginx adminer php-fpm mysql
	@docker network rm localnet

bash:
	@docker exec -it php-fpm sh

test:
	@$(PHP_EXEC) /var/www/vendor/bin/phpunit $(ARG)

query:
	@$(PHP_EXEC) php_apache $(ARG)


# Mysql commands:
dump:
	@docker exec mysql mariadb-dump \
	--no-tablespaces \
	-u $(MYSQL_USER) \
	--password=$(MYSQL_PASSWORD) \
	$(MYSQL_DATABASE) > ./docker/db/$(MYSQL_DATABASE).sql


# Composer commands:
cinit:
	@$(COMPOSER) init --description '' --no-interaction

cinstall:
	@$(COMPOSER) install --no-interaction --prefer-dist

cupdate:
	@$(COMPOSER) update --with-all-dependencies

cautoload:
	@$(COMPOSER) dump-autoload --optimize

crequire:
	@$(COMPOSER) require $(PKG) $(ARG) --no-interaction

cremove:
	@$(COMPOSER) remove $(PKG) $(ARG)