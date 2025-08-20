@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Админ-панель: Модерация историй</h1>
    </div>

    <!-- Фильтры -->
    <div class="mb-4">
        <a href="{{ route('admin.stories.index') }}" class="btn btn-outline-secondary">Все</a>
        <a href="{{ route('admin.stories.index', ['status' => 'pending']) }}" class="btn btn-warning">На модерации</a>
        <a href="{{ route('admin.stories.index', ['status' => 'approved']) }}" class="btn btn-success">Одобрены</a>
        <a href="{{ route('admin.stories.index', ['status' => 'rejected']) }}" class="btn btn-danger">Отклонены</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($stories->isEmpty())
        <div class="alert alert-info">Нет историй для отображения.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Автор</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($stories as $story)
                    <tr>
                        <td>{{ $story->id }}</td>
                        <td>{{ Str::limit($story->title, 50) }}</td>
                        <td>{{ $story->user->name }}</td>
                        <td>
                            @if ($story->status === 'pending')
                                <span class="badge bg-warning">На модерации</span>
                            @elseif ($story->status === 'approved')
                                <span class="badge bg-success">Одобрена</span>
                            @else
                                <span class="badge bg-danger">Отклонена</span>
                            @endif
                        </td>
                        <td>{{ $story->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <a href="{{ route('stories.showElement', $story->id) }}" class="btn btn-sm btn-info">Просмотр</a>

                            @if ($story->status === 'pending')
                                <form method="POST" action="{{ route('admin.stories.approve', $story->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Одобрить</button>
                                </form>

                                <form method="POST" action="{{ route('admin.stories.reject', $story->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Отклонить</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Пагинация -->
        <div class="d-flex justify-content-center">
            {{ $stories->links() }}
        </div>
    @endif
@endsection
