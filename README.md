# Instalar o docker

sudo apt-get update

### Adicionando as chaves 
sudo apt-key adv --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys 58118E89F3A912897C070ADBF76221572C52609D

### Adicionando o repositorio

sudo apt-add-repository 'deb https://apt.dockerproject.org/repo ubuntu-xenial main'

sudo apt-get update

sudo apt-get install -y docker-engine

#### Verifica a instalação

sudo systemctl status docker
	

#Instalar o Docker compose

### Baixar o docker compose
sudo curl -L https://github.com/docker/compose/releases/download/1.18.0/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose

dar perimssão para os arquivos
sudo chmod +x /usr/local/bin/docker-compose

### Verificar a instalação
$ docker-compose --version


## Usando o container

Entrar na pasta onde esta o projeto e rodar o comando para criar os containers

sudo docker-compose build


### Depois só iniciar os containers

docker-compose up

#### para acessar o mysql

docer exec -it mysql bash

para acessar o php, so alterar os arquivos na pasta www

servidor rodando em http://localhost

#### carregar o banco de dados

cat backup.sql | docker exec -i mysql /usr/bin/mysql -u root --password=secret imagenet