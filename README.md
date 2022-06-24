=## **Teste Fiep**
##### Esse projeto é feito em Laravel(PHP) com Vue.js(JavaScript)
##### Ele também conta com um Docker com o ambiente
#### Para Rodar precisa clonar o projeto
#### Dar permissão na pasta `sudo chmod -R 775 fiepTeste`
#### Entrar na pasta `cd fiepTeste`
#### Rodar o docker* `docker-composer up -d`
###### *precisa ter o docker instalado, eu utilizo o [docker para windows](https://docs.docker.com/desktop/windows/install/)
##### Rodar o comando `composer install`
#### Rodar o npm na pasta `npm run dev`(se for local) ou `npm run prod`(em produção)
#### Para facilitar no projeto está incluído o [Sail](https://laravel.com/docs/9.x/sail#main-content) por isso para facilitar podemos rodar os comandos `sail npm` `sail composer` `sail php artisan` com o sail na frente
#### Para evitar erros coloquei o comando de alias para poder só digitar o comando sem colocar o caminho do sail `alias  sail='[ -f sail ] && bash sail || bash vendor/bin/sail'`

#### Ainda na pasta temos que criar nossa base de dados usando o comando `sail php artisan migrate`