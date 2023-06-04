## MyExtra
Сайт с анонсами международных и локальных мероприятий для школьников (в т.ч. школьников Казахстана, СНГ и англоговорящих школьников всего мира), позволяющий развивать навыки и формировать портфолио для ВУЗа и карьеры.

## Installation
### Windows
1. Скачайте php v8.2 c [офф сайта](https://www.php.net/downloads.php)
2. Зайти в "Изменение системных переменных среды" -> Переменые среды -> В системных переменных найдите Path -> добавте новое поле путь к папке php.exe, пример - C:\Users\User\Desktop\Programming\Data\sdk\php82
3. Измените параметры php.ini  
4. Скачайте MySQL - https://dev.mysql.com/downloads/installer/
5. Создайте бд MySQL, называние бд любое
6. Скачайте дамп баззы данных (попросите у него @Dtorossyan) и экспортируйте в свое бд
7. Измените файл /includes/database.inc.php под свою бд
8. запустите сервер php -> php -S localhost:8888

### Mac
1. Установите homebrew, следуя инструкциям на » [brew.sh](https://brew.sh/)
2. Cкачайте php -> brew install php
3. Измените параметры php.ini  
4. Скачайте MySQL - https://dev.mysql.com/downloads/installer/
5. Создайте бд MySQL, называние бд любое
6. Скачайте дамп баззы данных (попросите у него @Dtorossyan) и экспортируйте в свое бд
7. Измените файл /includes/database.inc.php под свою бд
8. запустите сервер php -> php -S localhost:8888

Для удобной работы с БД юзайте DBeaver

## Внутрении правила работы с гитом
Создавать себе ветку ее комитить ТОЛЬКО У СЕБЯ НА ЛОКАЛКЕ в гит ее заливать НЕ НУЖНО
Мержить все в ветку dev, main - только для прода
Все.

## Contributors

+ Torossyan David
+ Bogdan Suvernev
+ Аян

## License & Contributors
Copyright (c) 2023-2024 MyExtra.



