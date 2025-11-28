# MAGENTO 2 INSTALLATION (Docker Compose)
## Author
- Chaymae Belamkadem
## Prerequisites

Make sure you have:

✔ Docker

- docker -v
```
Docker version 28.0.4, build b8034c0
```
✔ Docker Compose

- docker-compose --version

```
docker-compose version 1.29.2, build 5becea4c
```

✔ git

- git --version
```
git version 2.43.0
```
✔ composer (on your host machine)

- composer --version
```
Composer version 2.9.2 2025-11-19 21:57:25
PHP version 8.5.0 (/usr/local/bin/php)
```

## Setup
### Create project folder
* mkdir magento2-docker
* cd magento2-docker

### Start the containers
* docker-compose up -d
* make

### Get the web container shell
* docker exec -it web bash

check php version inside the container : php -v

**create new db inside mysql container:**

1- docker exec -it mysql bash

2- mysql -h mysql -u root -proot

```
CREATE DATABASE chaymae_magento;
SHOW DATABASES;
SELECT * FROM core_config_data WHERE path = 'catalog/search/engine';

(should be elasticsearch8)
```

**check containers running :**

docker-compose ps

log into web container:
```
docker exec -it --user application web bash
```

cd app/

```
bin/magento setup:install \
--base-url="http://chaymae.magento" \
--db-host="mysql" \
--db-name="chaymae_magento" \
--db-user="root" \
--db-password="root" \
--admin-firstname="Admin" \
--admin-lastname="User" \
--admin-email="admin@example.com" \
--admin-user="admin" \
--admin-password="Admin123!" \
--language="en_US" \
--currency="EUR" \
--timezone="Europe/Berlin" \
--use-rewrites=1 \
--search-engine=elasticsearch8 \
--elasticsearch-host="magento_elasticsearch" \
--elasticsearch-port=9200
```

```
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento cache:flush
bin/magento indexer:reindex
```

**Disable the 2FA module via bin/magento:**

Magento_TwoFactorAuth is a dependency for Magento_AdminAdobeImsTwoFactorAuth
```
bin/magento module:disable Magento_AdminAdobeImsTwoFactorAuth Magento_TwoFactorAuth

bin/magento setup:upgrade

bin/magento cache:flush

bin/magento setup:di:compile
```

create account in:

https://repo.magento.com/

- username (public key): 7e45f93715c230cbcfb843dc9d9557cc

- password (private key): c459760d9a7bddb83d2c3b83fb8cddc2
```
php bin/magento sampledata:deploy
```
bin/magento setup:upgrade

- username (public key): 7e45f93715c230cbcfb843dc9d9557cc

- password (private key): c459760d9a7bddb83d2c3b83fb8cddc2


Log of elasticsearch:
```
docker logs magento2-docker_magento_elasticsearch_1
```
```
docker-compose down -v
rm -rf elasticsearch/
docker-compose up -d
```

```
mkdir -p ./elasticsearch
sudo chown -R 1000:1000 ./elasticsearch
sudo chmod -R 775 ./elasticsearch
```

curl http://magento_elasticsearch:9200

## Notes

`database name = chaymae_magento`

`url = http://chaymae.magento/`

`admin url = http://chaymae.magento/admin_6ecr29i`

`admin username = admin`

`admin password = Admin123!`

`phpMyAdmin = http://127.0.0.1:8080/`
