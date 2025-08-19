<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Рассказать историю — Интересные истории</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
            background: #f9f9f9;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1em;
        }
        textarea {
            height: 200px;
            resize: vertical;
        }
        .hint {
            font-size: 0.9em;
            color: #666;
            margin-top: 5px;
        }
        .btn {
            background: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
        }
        .btn:hover {
            background: #2980b9;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .error {
            color: #e74c3c;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="back-link">← На главную</a>

    <h1>Расскажи свою историю</h1>

    <form method="POST" action="{{ route('story.store') }}">
        @csrf

        <div class="form-group">
            <label>Заголовок</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Текст истории</label>
            <textarea name="content" required>{{ old('content') }}</textarea>
            @error('content')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Теги</label>
            <input type="text" name="tags" value="{{ old('tags') }}" placeholder="путешествия, любовь, работа">
            <div class="hint">
                Через запятую. Например: <code>путешествия, приключения, горы</code>
            </div>
            @error('tags')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn">Отправить на модерацию</button>
    </form>
</body>
</html>