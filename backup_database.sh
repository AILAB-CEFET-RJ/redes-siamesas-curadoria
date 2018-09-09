#!/bin/bash

echo "Iniciando o backup do banco de dados ..."
docker exec mysql /usr/bin/mysqldump -u root --password=secret imagenet > backup_22082018.sql
echo "Backup finalizando com sucesso."
