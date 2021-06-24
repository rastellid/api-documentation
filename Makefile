up:
	docker-compose up -d

stop:
	docker-compose stop

php-shell:
	docker exec -it app_php /bin/bash

php-cs-check:
	docker exec app_php /bin/bash -c "cd /var/www/app && php-cs-fixer fix --dry-run -v"

php-cs-fix:
	docker exec app_php /bin/bash -c "cd /var/www/app && php-cs-fixer fix -v"

php-psalm:
	docker exec app_php /bin/bash -c "cd /var/www/app && vendor/bin/psalm"