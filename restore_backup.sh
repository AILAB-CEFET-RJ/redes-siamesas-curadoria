#!/bin/bash

echo "Iniciando o restore do banco de dados ..."
cat backup.sql | docker exec -i mysql /usr/bin/mysql -u root --password=secret imagenet
echo "Restore finalizando com sucesso."