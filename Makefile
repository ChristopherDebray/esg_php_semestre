composer-install:
	docker exec -it 3j-2023-web-1 bash -c "composer install"

setup-project:
	docker exec -it 3j-2023-web-1 bash -c "composer install"
	cd ./bootstrap_custom/src && npm run init-bootstrap