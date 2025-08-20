@extends('layouts.app')

@section('content')
    <h2>Истории с тегом: #{{ $tag->name }}</h2>

    @if ($stories->isEmpty())
        <div class="alert alert-info">
            Пока нет ни одной истории с этим тегом.
        </div>
    @else
        <div class="row">
            @foreach ($stories as $story)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5><a href="{{ route('stories.showElement', $story->id) }}">{{ $story->title }}</a></h5>
                            <p class="text-muted">{{ Str::limit($story->content, 100) }}</p>
                            <small>Автор: <strong>{{ $story->user->name }}</strong></small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $stories->links() }}
        </div>
    @endif

    <div class="mt-3">
        <a href="{{ url()->previous() }}" class="btn btn-link">← Назад</a>
    </div>
@endsection
