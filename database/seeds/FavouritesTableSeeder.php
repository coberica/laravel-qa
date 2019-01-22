<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\User;

class FavouritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('favourites')->delete();

        $users=User::pluck('id')->all();
        $numberOfUsers=count($users);

        foreach(Question::all() as $question){
            for($i=0;$i<rand(1,$numberOfUsers);$i++){
                $question->favourites()->attach($users[$i]);
            }
        }
    }
}
