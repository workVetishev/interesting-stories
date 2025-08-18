<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'путешествия',
            'еда',
            'природа',
            'технологии',
            'книги',
            'музыка',
            'спорт',
            'искусство',
            'наука',
            'история',
            'культура',
            'животные',
            'город',
            'село',
            'работа'
        ];
        foreach ( $tags as $tag )
        {
            DB::table('tags')->updateOrInsert(
                [
                    'name' => $tag
                ],
                [
                    'name' => $tag,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
        
    }
}
