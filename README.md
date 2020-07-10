### Тестовое задание

Все указанные пароли в файлах сделаны из-за быстрой разработки

Порядок развертывания приложения

1. Клонируем репозиторий
2. Запускаем окружение ``docker-compose up -d``
3. Устанаваливаем библиотеки ``docker exec currency_app composer install --no-dev``
4. Запускаем команду для сохранения в redis ``docker exec currency_app php yii demon``
5. Устанваливаем cron ``@hourly docker exec currency_app php /var/www/yii demon >> /dev/null``