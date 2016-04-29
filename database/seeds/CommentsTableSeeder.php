<?php

use App\Models\Comment;
use App\Models\Work;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $work = Work::find(1);
        $comments = [];
        for ($i = 0; $i <= 10; $i++) {
            $comments[] = Comment::create([
                'description' => $faker->sentence(5),
                'commentable_id' => 1
            ]);
        }
        $work->comments()->saveMany($comments);
    }
}
