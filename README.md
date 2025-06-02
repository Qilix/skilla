Laravel (local) + db (docker)

1. Установить зависимости
   ```
   composer install
   ```
2. Установить миграции
   ```
   php artisan migrate
   ```
3. Создание клиента персонального доступа

   ```
   php artisan passport:client --personal
   ```
4. Запустить сиды
   ```
   php artisan db:seed
   
   php artisan db:seed --class=OrderTypeSeeder
   ```
5. Обновить кеш роутов
   ```
   php artisan route:cache
   ```
   
   Endpoints:
   ~~~
   /api/order/ - Создание заказа
   /api/order/:order_id/assign - Назначить исполнителя
   /api/worker/ - Посмотреть отфильтрованных исполнителей
   ~~~