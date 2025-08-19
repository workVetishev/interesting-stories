<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $story->title }} — Интересные истории</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .meta {
            font-size: 0.9em;
            color: #7f8c8d;
            margin-bottom: 20px;
        }
        .tags {
            margin: 20px 0;
        }
        .tags a {
            display: inline-block;
            padding: 5px 10px;
            background: #ecf0f1;
            color: #2c3e50;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9em;
            margin-right: 5px;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>{{ $story->title }}</h1>

    <div class="meta">
        Автор: <strong>{{ $story->user->name }}</strong> ·
        {{ $story->created_at->format('d.m.Y в H:i') }}
    </div>

    <div class="content">
        <p>{!! nl2br(e($story->content)) !!}</p>
    </div>

    <!-- Теги -->
    @if ($story->tags->isNotEmpty())
        <div class="tags">
            Теги:
            @foreach ($story->tags as $tag)
                <a href="{{ route('tag.show', $tag->name) }}">#{{ $tag->name }}</a>
            @endforeach
        </div>
    @endif

    <a href="{{ url()->previous() }}" class="back-link">← Назад</a>
</body>
</html>