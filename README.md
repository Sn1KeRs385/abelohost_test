Для разворачивания в докере:
1) .env.example => скопировать в => .env
2) docker-compose.develop.yml => скопировать в => docker-compose.yml
3) /www/vue-crud/.env.example => /www/vue-crud/.env
4) /www/laravel/.env.example => /www/laravel/.env
5) /nginx/develop.conf => /nginx/conf.d/default.conf
6) после запуска контейнеров выполнить:
<br>6.1) docker-compose exec laravel composer install
<br>6.2) docker-compose exec laravel php artisan migrate
<br>6.3) docker-compose exec laravel php artisan db:seed
7) если запуск на локальной машине, не забудьте прописать хосты (/etc/hosts) 