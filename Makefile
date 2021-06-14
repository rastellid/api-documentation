up:
	docker-compose up -d

stop:
	docker-compose stop

php-shell:
	docker exec -it 01-graphql_graph_php_1 /bin/bash