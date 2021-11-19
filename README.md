Para rodar o projeto

O projeto roda com docker, verificar se o Docker esta instalado na sua máquina, se não estiver acesse: https://docs.docker.com/engine/install

- Criar uma pasta
- Clonar o projeto
- Verificar a branch (Versão atual Development)
- subir o projeto com docker-compose up -d
- Usar o .env-example como base copiar, colar e renomear para .env e colocar as configurações do banco
    DB_DATABASE=nome_do_banco
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha

- Rodar os comandos
    docker-compose exec app composer update &&
    docker-compose exec app php artisan migrate &&
    docker-compose exec app php artisan passport:install &&
    docker-compose exec app php artisan key:generate &&
    docker-compose exec app php artisan repair:structure

O projeto esta rodando na porta 7000



