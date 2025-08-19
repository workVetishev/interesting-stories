<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class StoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(TagsSeeder::class);

        $marina = DB::table('users')->where('email', 'marina@example.com')->first();
        $dmitry = DB::table('users')->where('email', 'dmitry@example.com')->first();

        if (!$marina && !$dmitry)
        {
            $this->command->error('Пользователи не найдены. Запустите UsersSeeder');
            return;
        }

        $stories = [
            // Марина
            [
                'title'   => 'Мое первое путешествие в горы',
                'content' => 'Это была незабываемая поездка в Кавказские горы. Пейзажи захватывали дух, а местные жители были невероятно гостеприимны. Мы поднимались на высоту 3000 метров и видели рассвет над облаками.',
                'status'  => 'pending',
                'tags'    => ['путешествия', 'природа', 'горы'],
                'user_id' => $marina->id,
            ],
            [
                'title'   => 'Лучшие книги 2024 года',
                'content' => 'В этом году я прочитал более 50 книг. Хочу поделиться своими любимыми произведениями. Особенно впечатлил роман "Ночь горы" и сборник рассказов современного автора.',
                'status'  => 'pending',
                'tags'    => ['книги', 'литература', 'обзор'],
                'user_id' => $marina->id,
            ],
            [
                'title'   => 'История одного старинного замка',
                'content' => 'Посетив замок XII века, я был поражен его архитектурой и историей. Каждая комната рассказывала свою историю, а подземелья скрывали много тайн.',
                'status'  => 'pending',
                'tags'    => ['история', 'архитектура', 'путешествия'],
                'user_id' => $marina->id,
            ],

            // Дмитрий
            [
                'title'   => 'Рецепт лучшего кофе',
                'content' => 'После месяцев экспериментов я нашел идеальный способ заваривания кофе. Главное - свежемолотые зерна и температура воды 92 градуса. Добавьте немного корицы для аромата.',
                'status'  => 'approved',
                'tags'    => ['еда', 'кофе', 'рецепты'],
                'user_id' => $dmitry->id,
            ],
            [
                'title'   => 'Мой первый марафон',
                'content' => '42 километра казались невозможной задачей, но подготовка и настойчивость помогли мне пересечь финишную черту. Это невероятное чувство достижения!',
                'status'  => 'approved',
                'tags'    => ['спорт', 'марафон', 'мотивация'],
                'user_id' => $dmitry->id,
            ],
            [
                'title'   => 'Как начать играть на гитаре',
                'content' => 'Изучение гитары требует терпения и регулярной практики. Я делюсь своими первыми шагами и упражнениями, которые помогут новичкам быстрее прогрессировать.',
                'status'  => 'approved',
                'tags'    => ['музыка', 'гитара', 'обучение'],
                'user_id' => $dmitry->id,
            ],

            // Отклонённые (можно от любого)
            [
                'title'   => 'Как я выучил Laravel за месяц',
                'content' => 'Изучение фреймворка Laravel было сложным, но увлекательным процессом. Я начал с основ маршрутизации и постепенно перешел к сложным концепциям, таким как Eloquent ORM и Queues.',
                'status'  => 'rejected',
                'tags'    => ['технологии', 'программирование', 'обучение'],
                'user_id' => $marina->id,
            ],
            [
                'title'   => 'Секреты ухода за комнатными растениями',
                'content' => 'После двух лет экспериментов с комнатными растениями я собрал список проверенных методов. Главное - правильный полив и достаточное освещение.',
                'status'  => 'rejected',
                'tags'    => ['природа', 'растения', 'дом'],
                'user_id' => $dmitry->id,
            ],
        ];

        foreach ($stories as $story)
        {
            $storyId = DB::table('stories')->insertGetId([
                'title'      => $story['title'],
                'content'    => $story['content'],
                'status'   => $story['status'],
                'user_id' => $story['user_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if(isset($story['tags']))
            {
                $tagsId = DB::table('tags')
                    ->whereIn('name', $story['tags'])
                    ->pluck('id');

                $storyTagData = $tagsId->map(function($tagId) use ($storyId)
                {
                    return [
                        'story_id'   => $storyId,
                        'tag_id'     => $tagId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->toArray();

                DB::table('story_tag')->insert($storyTagData);
            }

        }

        
    }
}
