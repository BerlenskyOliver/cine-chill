<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_main_page_correct_info(){

        $reponse = $this->get(route('movies.index'));

        $reponse->assertSuccessful();
        $reponse->assertSee('Popular movies');
    }

    public function test_search_dropdown(){
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=jumanji', 'results' => [
                1 =>  [
    "popularity" => 47.99,
    "vote_count" => 3995,
    "video" => false,
    "poster_path" => "/jyw8VKYEiM1UDzPB7NsisUgBeJ8.jpg",
    "id" => 512200,
    "adult" => false,
    "backdrop_path" => "/zTxHf9iIOCqRbxvl8W5QYKrsMLq.jpg",
    "original_language" => "en",
    "original_title" => "Jumanji: The Next Level",
    'genres_ids' => [
        13, 6, 5,
    ],
    "title" => "Jumanji",
    "vote_average" => 6.9,
    "overview" => "As the gang return to Jumanji to rescue one of their own, they discover that nothing is as they expect. The players will have to brave parts unknown and unexplo ",
    "release_date" => "2019-12-04",
                ],
  2 => [
    "popularity" => 32.121,
    "vote_count" => 9399,
    "video" => false,
    "poster_path" => "/22hqf97LadMvkd4zDi3Bq25xSqD.jpg",
    "id" => 353486,
    "adult" => false,
    "backdrop_path" => "/rz3TAyd5kmiJmozp3GUbYeB5Kep.jpg",
    "original_language" => "en",
    'genres_ids' => [
        13, 6, 5,
    ],
    "original_title" => "Jumanji",
    "title" => "Jumanji: Welcome to the Jungle",
    "vote_average" => 6.8,
    "overview" => "The tables are turned as four teenagers are sucked into Jumanji's world - pitted against rhinos, black mambas and an endless variety of jungle traps and puzzles ",
    "release_date" => "2017-12-09",
  ]
            ] 
        ]);

        Livewire::test('search-dropdown')
            ->assertDontSee('Jumanji')
            ->set('search', 'jumanji')
            ->assertSee('Jumanji');
    }
    
}
