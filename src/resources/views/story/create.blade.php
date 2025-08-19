<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создать историю</title>
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .checkbox { margin: 5px 0; }
        .error { color: red; font-size: 0.9em; margin-top: 5px; }
        .btn { background: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>Создать новую историю</h1>

    @if (isset($errors) && $errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('stories.createElement') }}">
        @csrf

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                value="{{ old('title', $fields['title'] ?? '') }}" 
                placeholder="Введите заголовок"
            >
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="contents">Содержание</label>
            <textarea 
                name="content" 
                id="contents" 
                rows="6" 
                placeholder="Введите текст истории"
            >{{ old('content', $fields['content'] ?? '') }}</textarea>
            @error('content')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="checkbox">
                <input type="checkbox" name="approved" value="1" {{ old('approved', $fields['approved'] ?? false) ? 'checked' : '' }}>
                Опубликовать
            </label>
            @error('approved')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn">Создать историю</button>
    </form>
</body>
</html>