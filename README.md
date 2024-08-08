# Настройка проекта

1) Запускаем компанду для сборки стека проекта.
```bash
docker-compose up -d
```

2) Проверяем, что все контейнеры запустились и работают.
```bash
docker-compose ps
```
3) Устанавливаем Composer зависимости.
```bash
docker-compose run --rm composer install 
```
4) Проверяем, что все хорошо.
```bash
docker-compose run --rm artisan
```
5) База доступна по следующим параметрам. Эти параметры мы заменяем в файле конфигураций .env
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
6) Запускаем миграции
```bash
docker-compose run --rm artisan migrate
```
Сервис доступен по [http://localhost](http://localhost)

# Методы сервиса
## Авторизация
Для работы сервиса нужен Bearer Token. Чтобы его получить вам нужно зарегистрироваться и авторизоваться.

#### Регистрация `POST`
```
POST {base_url}/api/v1/auth/register
```
Тело запроса:
```json
{
    "name": "gleb",
    "email": "gleb@mail.ru",
    "password": "12345"
}
```
Ответ запроса:
```json
{
    "message": "success",
    "status": 201
}
```
#### Авторизация `POST`
```
{base_url}/api/v1/auth/login
```
Тело запроса:
```json
{
    "email": "gleb@mail.ru",
    "password": "12345"
}
```
Ответа запроса:
```json
{
    "user": {
        "id": 12,
        "name": "gleb",
        "email": "gleb@mail.ru",
        "email_verified_at": null,
        "created_at": "2024-08-08T12:50:04.000000Z",
        "updated_at": "2024-08-08T12:50:04.000000Z"
    },
    "bearer_token": "6|Jfhhoac2xQE8fVux8GlUdgKQIr0YLxIlrU0wnfbi3d754c2f"
}
```

## Гостиница
Здесь все CRUD операции для работы с гостем.
#### Создать гостя `POST`
```
{base_url}/api/v1/guest/create
```
Тело запроса:
```json
{
    "name": "Gleb",
    "surname": "Shalygin",
    "email": "gleb@mail.ru",
    "phone": "+79081153004",
    "country": "Россия"
}
```
Ответа запроса:
```json
{
    "data": {
        "name": "Gleb",
        "surname": "Shalygin",
        "email": "gleb@mail.ru",
        "phone": "+79081153004",
        "country": "Россия",
        "updated_at": "2024-08-08T12:55:30.000000Z",
        "created_at": "2024-08-08T12:55:30.000000Z",
        "id": 15
    }
}
```
#### Получить гостя `GET`
```
{base_url}/api/v1/guest/get/15
```
Ответа запроса:
```json
{
    "id": 15,
    "name": "Gleb",
    "surname": "Shalygin",
    "email": "gleb7@mail.ru",
    "phone": "+79081153007",
    "country": "Россия",
    "created_at": "2024-08-08T12:55:30.000000Z",
    "updated_at": "2024-08-08T12:55:30.000000Z"
}
```
#### Получить всех гостей `GET`
```
{base_url}/api/v1/guest/get
```
Ответа запроса:
```json
[
    {
        "id": 15,
        "name": "Gleb",
        "surname": "Shalygin",
        "email": "gleb@mail.ru",
        "phone": "+79081153004",
        "country": "Россия",
        "created_at": "2024-08-08T05:44:57.000000Z",
        "updated_at": "2024-08-08T05:44:57.000000Z"
    },
    {
        "id": 12,
        "name": "Arkasha",
        "surname": "Ivanov",
        "email": "ivanov@mail.ru",
        "phone": "+79081153006",
        "country": "Россия",
        "created_at": "2024-08-08T06:02:49.000000Z",
        "updated_at": "2024-08-08T06:02:49.000000Z"
    }
]
```
#### Обновить гостя `POST`
```
{base_url}/api/v1/guest/update
```
Тело запроса (обязательно должен присутстовать id записи, которую хотите обновить):
```json
{
    "id": 15,
    "name": "Anton",
    "surname": "Shalygin",
    "email": "gleb@mail.ru",
    "phone": "+79081153004",
    "country": "Россия"
}
```
Ответа запроса:
```json
{
    "message": "The data has been successfully updated"
}
```
#### Обновить гостя `POST`
```
{base_url}/api/v1/guest/delete
```
Тело запроса:
```json
{
    "id": 15
}
```
Ответа запроса:
```json
{
    "message": "The record was successfully deleted"
}
```

## Заключение
Хотел ещё написать тесты и возвращать всё через ресурсы, но ударилось все во время и в дела по основной работе. 

Надеюсь написанием авторизации от основной мысли задачи не ушёл, так как пользователю в любом случае нужно получить доступ, чтобы использовать сервис. Можно было сделать параметр и ссылаться на него в конфиге, но думаю данным подходом будет удобно не залазить в код (почти, с бд нужно будет в .env залезть)

Чуть позже для себя доведу данный сервис до ума и помещу в портфолио. CRUD операциями занимаюсь чуть ли не каждый месяц, но думаю не лишним будет и это сервис.
