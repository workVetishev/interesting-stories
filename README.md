## 📋 Техническое задание для проекта "Интересные истории" (для бэкенд разработчика)

### 🎯 Цель проекта
Разработать API и серверную логику для веб-приложения публикации и модерации пользовательских историй с хештегами.

### ⚙️ Архитектура приложения

#### Backend стек:
- Laravel 10+ (API)
- PHP 8.1+
- MySQL 8.0
- Docker для разработки и деплоя
- RESTful API архитектура

#### Frontend (отдельно):
- Любой современный фронтенд фреймворк (Vue.js, React, Angular)
- Общение с бэкендом через API endpoints

### 🗃️ Структура данных и модели

#### Таблица `stories`:
```php
Schema::create('stories', function (Blueprint $table) {
    $table->id();
    $table->string('title', 255);
    $table->text('content');
    $table->boolean('approved')->default(false);
    $table->timestamps();
});
```

#### Таблица `tags`:
```php
Schema::create('tags', function (Blueprint $table) {
    $table->id();
    $table->string('name', 255)->unique();
    $table->timestamps();
});
```

#### Таблица `story_tag` (many-to-many):
```php
Schema::create('story_tag', function (Blueprint $table) {
    $table->id();
    $table->foreignId('story_id')->constrained()->onDelete('cascade');
    $table->foreignId('tag_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
```

### 🔄 API Endpoints

#### Публичные endpoints:
```
GET    /api/stories              # Список одобренных историй (пагинация)
GET    /api/stories/{id}         # Просмотр одобренной истории
POST   /api/stories              # Создание новой истории
GET    /api/tags                 # Список всех хештегов
GET    /api/tags/{id}/stories    # Истории по конкретному хештегу
```

#### Админские endpoints:
```
GET    /api/admin/stories        # Все истории (с фильтрацией по статусу)
POST   /api/admin/stories/{id}/approve  # Одобрение истории
POST   /api/admin/stories/{id}/reject   # Отклонение истории
DELETE /api/admin/stories/{id}          # Удаление истории
```

### 🏗️ Основные компоненты бэкенда

#### 1. Модели:
- `App\Models\Story` (с отношениями)
- `App\Models\Tag` (с отношениями)

#### 2. Контроллеры:
- `App\Http\Controllers\Api\StoryController`
- `App\Http\Controllers\Api\TagController`
- `App\Http\Controllers\Api\Admin\StoryController`

#### 3. Request валидация:
- `App\Http\Requests\StoreStoryRequest`
- `App\Http\Requests\UpdateStoryRequest`

#### 4. Ресурсы API:
- `App\Http\Resources\StoryResource`
- `App\Http\Resources\StoryCollection`
- `App\Http\Resources\TagResource`

#### 5. Middleware:
- `EnsureStoryIsApproved` (для публичных endpoints)
- `AdminMiddleware` (для админских endpoints)

#### 6. Сервисы (по необходимости):
- `App\Services\TagService` (обработка хештегов)
- `App\Services\ModerationService` (логика модерации)

### 🔧 Бизнес-логика

#### Обработка хештегов:
- Парсинг строки хештегов из запроса
- Создание новых тегов при необходимости
- Связывание истории с тегами (many-to-many)
- Нормализация хештегов (удаление #, приведение к нижнему регистру)

#### Модерация:
- Новые истории по умолчанию `approved = false`
- Админ может одобрить или отклонить историю
- При отклонении история либо удаляется, либо скрывается

#### Пагинация:
- Публичный API: 10 историй на страницу
- Админ API: 20 историй на страницу
- Поддержка параметров `page`, `per_page`

### 🛡️ Безопасность

#### Валидация:
- Обязательные поля: title, content
- Максимальная длина: title (255), content (без ограничений или до 65k)
- Формат хештегов: массив строк или строка с разделителями

#### Санитизация:
- Очистка HTML из content (опционально, в зависимости от требований)
- Валидация имен хештегов (только буквы, цифры, дефисы, подчеркивания)

#### Rate limiting:
- Ограничение на создание историй (например, 10 в час с IP)

### 🐳 Docker конфигурация

#### Сервисы:
- `app` - PHP 8.2-fpm с необходимыми расширениями
- `nginx` - веб-сервер на порту 8000
- `db` - MySQL 8.0 на порту 3307 (внешне) / 3306 (внутри сети)

#### Volume монтирование:
- `./src:/var/www` для разработки в реальном времени

### 📊 Тестирование

#### Unit тесты:
- Модели Story и Tag
- Логика обработки хештегов
- Методы модерации

#### Feature тесты:
- API endpoints
- Создание историй
- Модерация
- Пагинация

### 📁 Структура проекта:
```
interesting-stories/
├── docker/                 
│   ├── php/Dockerfile     
│   ├── nginx/nginx.conf   
│   └── docker-compose.yml 
├── src/                   # Laravel приложение
│   ├── app/              
│   │   ├── Models/
│   │   ├── Http/
│   │   │   ├── Controllers/Api/
│   │   │   ├── Controllers/Api/Admin/
│   │   │   ├── Requests/
│   │   │   ├── Resources/
│   │   │   └── Middleware/
│   │   ├── Services/
│   │   └── Providers/
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   ├── routes/
│   │   ├── api.php
│   │   └── admin.php
│   ├── tests/
│   └── config/
└── README.md             
```

### 🎯 Критерии готовности бэкенда:
- [ ] Все модели и миграции созданы и протестированы
- [ ] RESTful API endpoints реализованы
- [ ] Валидация входных данных
- [ ] Логика модерации работает
- [ ] Обработка хештегов реализована
- [ ] API задокументирован (Postman collection или OpenAPI)
- [ ] Unit и Feature тесты написаны
- [ ] Проект запускается через Docker
- [ ] Код следует PSR стандартам и Laravel conventions

---

Теперь у тебя есть четкое техническое задание для реализации бэкенд части проекта! 🚀
