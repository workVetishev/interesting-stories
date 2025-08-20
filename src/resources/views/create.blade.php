@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Расскажи свою историю</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('stories.createElement') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Заголовок</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                            @error('title')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Текст истории</label>
                            <textarea name="content" class="form-control" rows="6" required>{{ old('content') }}</textarea>
                            @error('content')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Теги</label>
                            <input type="text" name="tags" value="{{ old('tags') }}" class="form-control" placeholder="путешествия, любовь, работа">
                            <small class="text-muted">Через запятую</small>
                            @error('tags')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Отправить на модерацию</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
