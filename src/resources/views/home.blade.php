@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Заголовок и призыв -->
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Интересные истории</h1>
            <p class="lead text-muted">
                Делись своими жизненными случаями, читай удивительные истории других.
            </p>
            <a href="#" class="btn btn-primary btn-lg">Рассказать свою историю</a>
        </div>

        <!-- Поиск по тегам (статично) -->
        <div class="mb-4 text-center">
            <p class="d-inline-block bg-light px-3 py-2 rounded">
                Популярные теги:
                <a href="#" class="badge bg-secondary text-decoration-none">#путешествия</a>
                <a href="#" class="badge bg-secondary text-decoration-none">#работа</a>
                <a href="#" class="badge bg-secondary text-decoration-none">#любовь</a>
                <a href="#" class="badge bg-secondary text-decoration-none">#семья</a>
                <a href="#" class="badge bg-secondary text-decoration-none">#учёба</a>
            </p>
        </div>

        <!-- Лента историй -->
        <div class="row">
            <!-- История 1 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Как я случайно стал курьером в Париже</h5>
                        <p class="card-text text-muted">
                            Поехал в отпуск, потерял чемодан, а через час уже возил еду на велосипеде...
                        </p>
                        <div class="mt-auto">
                            <small class="text-muted">
                                Автор: <strong>Алексей</strong><br>
                                12 апреля 2025
                            </small>

                            <!-- Теги -->
                            <div class="mt-2">
                                <a href="#" class="badge bg-secondary text-decoration-none">#путешествия</a>
                                <a href="#" class="badge bg-secondary text-decoration-none">#франция</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <a href="#" class="btn btn-outline-primary btn-sm">Читать полностью</a>
                    </div>
                </div>
            </div>

            <!-- История 2 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Собеседование, на которое я опоздал на 2 часа</h5>
                        <p class="card-text text-muted">
                            Думал, меня уволят, но через неделю получил оффер...
                        </p>
                        <div class="mt-auto">
                            <small class="text-muted">
                                Автор: <strong>Марина</strong><br>
                                10 апреля 2025
                            </small>
                            <div class="mt-2">
                                <a href="#" class="badge bg-secondary text-decoration-none">#работа</a>
                                <a href="#" class="badge bg-secondary text-decoration-none">#собеседование</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <a href="#" class="btn btn-outline-primary btn-sm">Читать полностью</a>
                    </div>
                </div>
            </div>

            <!-- История 3 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Кот, который спас мою семью</h5>
                        <p class="card-text text-muted">
                            Ночью начал мяукать и царапать дверь. Оказалось — задымилось в подвале...
                        </p>
                        <div class="mt-auto">
                            <small class="text-muted">
                                Автор: <strong>Дмитрий</strong><br>
                                8 апреля 2025
                            </small>
                            <div class="mt-2">
                                <a href="#" class="badge bg-secondary text-decoration-none">#семья</a>
                                <a href="#" class="badge bg-secondary text-decoration-none">#животные</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <a href="#" class="btn btn-outline-primary btn-sm">Читать полностью</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Пагинация (статично) -->
        <div class="d-flex justify-content-center my-4">
            <nav>
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Назад</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Вперёд</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection