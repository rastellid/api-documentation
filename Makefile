up:
	docker-compose up -d

stop:
	docker-compose stop

php-shell:
	docker exec -it 01-graphql_graph_php_1 /bin/bash

php-cs-check:
	docker exec 01-graphql_graph_php_1 /bin/bash -c "cd /var/www/app && php-cs-fixer fix --dry-run -v"

php-cs-fix:
	docker exec 01-graphql_graph_php_1 /bin/bash -c "cd /var/www/app && php-cs-fixer fix -v"