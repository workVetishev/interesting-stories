<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Истории с тегом: #{{ $tag->name }} — Интересные истории</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background: #f9f9f9;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .story-card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .story-card h3 {
            margin: 0 0 10px;
            font-size: 1.3em;
            color: #2980b9;
        }
        .story-card p {
            margin: 0 0 15px;
            line-height: 1.6;
        }
        .meta {
            font-size: 0.9em;
            color: #7f8c8d;
            margin-bottom: 10px;
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
        .pagination {
            display: flex;
            justify-content: center;
            margin: 30px 0;
        }
        .pagination a, .pagination span {
            margin: 0 5px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #3498db;
        }
        .pagination .current {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }
    </style>
</head>
<body>
<a href="{{ url()->previous() }}" class="back-link">← Назад</a>

<h1>Истории с тегом: #{{ $tag->name }}</h1>

@if ($stories->isEmpty())
    <p>Пока нет ни одной опубликованной истории с этим тегом.</p>
@else
    @foreach ($stories as $story)
        <div class="story-card">
            <h3><a href="{{ route('stories.showElement', $story->id) }}">{{ $story->title }}</a></h3>
            <div class="meta">
                Автор: <strong>{{ $story->user->name }}</strong> ·
                {{ $story->created_at->format('d.m.Y') }}
            </div>
            <p>{{ Str::limit($story->content, 200) }}</p>
            <a href="{{ route('stories.showElement', $story->id) }}" class="btn">Читать полностью →</a>
        </div>
    @endforeach

    <!-- Пагинация -->
    <div class="pagination">
        {{ $stories->links() }}
    </div>
@endif
</body>
</html>
