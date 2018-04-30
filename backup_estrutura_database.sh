#!/bin/bash

echo "Iniciando o backup do banco de dados ..."
docker exec mysql /usr/bin/mysqldump -u root --password=secret --no-data imagenet > backup_estrutura.sql
echo "Backup finalizando com sucesso."
