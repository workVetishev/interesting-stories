<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Интересные истории</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f9f9f9; }
        .story { margin-bottom: 30px; padding: 15px; background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .story h2 { margin: 0 0 10px; font-size: 1.4em; color: #2c3e50; }
        .story p { margin: 0 0 10px; line-height: 1.6; }
        .meta { font-size: 0.9em; color: #7f8c8d; margin-bottom: 10px; }
        .btn { display: inline-block; padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 4px; font-size: 0.9em; }
        .btn:hover { background: #2980b9; }
    </style>
</head>
<body>
    <h1>Интересные истории</h1>

    @if ($stories->isEmpty())
        <p>Пока нет ни одной опубликованной истории.</p>
    @else
        @foreach ($stories as $story)
            <div class="story">
                <h2>{{ $story->title }}</h2>
                <div class="meta">Автор: <strong>{{ $story->user->name }}</strong> · {{ $story->created_at->format('d.m.Y') }}</div>
                <p>{{ Str::limit($story->content, 200) }}</p>
                <a href="/stories/{{ $story->id }}" class="btn">Читать полностью</a>
            </div>
        @endforeach
    @endif
</body>
</html>