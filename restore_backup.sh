#!/bin/bash

echo "Iniciando o restore do banco de dados ..."
cat ramonsilva03_5b7c195a0ff61.sql | docker exec -i mysql /usr/bin/mysql -u root --password=secret imagenet
echo "Restore finalizando com sucesso."
