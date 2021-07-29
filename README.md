# Установка

1. Установите [docker](https://docs.docker.com/engine/install/ubuntu/) и [docker-compose](https://docs.docker.com/compose/install/);
1. В директории заготовки выполните команду `docker-compose up --build -d`;
1. Зайдите в контейнер `workspace` с помощью команды `docker-compose exec workspace sh`;
1. Выполните установку зависимостей командой `composer intall`
1. Выполните миграции в базу данных командой `./bin/console doctrine:migrations:migrate`

Точки доступа:
1. http://localhost/ads/relevant - открута рекламных объявлений
1. http://localhost/ads - добавление нового объявления
1. http://localhost/ads/{id} - редактирование объявления

#### Тело запроса для методов добавления и редактирования:
```
"text": "Advert"
"price": 150.00
"limit": 5
"banner": http://localhost.ru/ads