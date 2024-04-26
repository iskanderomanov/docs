# Инструкция по запуску проекта

## Шаг 1: Клонирование репозитория

Начните с клонирования репозитория на свою локальную машину. Это можно сделать с помощью команды:

```bash
git clone https://github.com/iskanderomanov/docs.git
```

## Шаг 2: Установка Docker и Docker Compose

Проект использует Docker и Docker Compose, поэтому вам нужно убедиться, что у вас установлены Docker и Docker Compose. Если у вас их еще нет, вы можете установить их, следуя официальной документации Docker.

## Шаг 3: Перейдите в каталог вашего проекта

```bash
cd docs
```

## Шаг 4: Настройка окружения:

скопируйте содержимое файла `.env.example` в `.env`

```bash
cp .env.example .env
```

## Шаг 5: Сборка и запуск Docker контейнеров:

выполните команду сборки:

```bash
docker-compose build
```

Запустите контейнеры Docker с помощью команды:

```bash
docker-compose up -d
```

## Шаг 6: Установка зависимостей PHP

Выполните установку зависимостей Composer c помощью make команды:

```bash
docker exec php-docs-container composer install
```

```bash
docker exec php-docs-container php artisan key:generate
```

## Шаг 7: Запуск миграций и сидеров:

выполните миграции и сидеры c помощью make команды:
``` bash
docker exec php-docs-container php artisan migrate --seed
```

## Шаг 8: Создаем HR manager 

Выполните следующую команду, чтобы создать:

```bash
docker exec php-docs-container php artisan command:create_hr
```

## Шаг 9: Доступ к  интерфейсу 

Вы можете получить доступ к интерфейсу по URL-адресу: http://localhost:8081/auth/login

Главный HR manager
```
email: dev@dev.dev 
password: developer
```
