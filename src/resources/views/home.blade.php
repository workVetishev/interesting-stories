@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Популярные истории</h1>

    @if ($stories->isEmpty())
        <div class="alert alert-info">
            Пока нет ни одной опубликованной истории.
        </div>
    @else
        <div class="row">
            @foreach ($stories as $story)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card story-card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ Str::limit($story->title, 60) }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($story->content, 120) }}
                            </p>
                            <div class="mt-auto">
                                <small class="text-muted">
                                    Автор: <strong>{{ $story->user->name }}</strong><br>
                                    {{ $story->created_at->format('d.m.Y') }}
                                </small>

                                <!-- Теги -->
                                <div class="mt-2">
                                    @foreach ($story->tags as $tag)
                                        <a href="{{ route('tags.show', $tag->name) }}" class="badge bg-secondary text-decoration-none">
                                            #{{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <a href="{{ route('stories.showElement', $story->id) }}" class="btn btn-outline-primary btn-sm">
                                Читать полностью
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Пагинация -->
        <div class="d-flex justify-content-center mt-4">
            {{ $stories->links() }}
        </div>
    @endif
@endsection
