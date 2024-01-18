<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Models\GameDb;
use App\Models\Players;

class GameController extends Controller
{
    //Creates new Game
    public function createNewGame(Request $request): RedirectResponse
    {
    
        //create the game 
        $game = GameDb::create(['userCreateId' => $request->user()->id]);
        $gameID = $game->id;
        //roles are 3 mafia ,1 detective, 1 doctor ,5 villagers
        $roles = [2, 3, 4, 4, 4, 4, 1, 1, 1, 4];
        shuffle($roles);

        // add the user to the game
        $singlePlayer = Players::create(['game_id' => $gameID, 'user_id' => $request->user()->id, 'role_id' => array_pop($roles), 'name' => $request->user()->name, 'is_bot' => 0]);

        //  random names
        $names = array(
            'Juan', 'Luis', 'Pedro', 'Zaira', 'Destin', 'Everett', 'Jaila',
            'Davonte', 'Howard', 'Stefany', 'Darwin', 'Stefanie', 'Sawyer',
            'Kasandra', 'Ella', 'Sandra', 'Demarco', 'Marian', 'Jacquelin',
            'Donavon', 'Eliza', 'Stella', 'Lela', 'Mercy', 'Kalynn', 'Kelsie',
            'Reagan', 'Malcolm', 'Ashleigh', 'Alea', 'Derick', 'Ashanti', 'Caylee'
        );
        shuffle($names);

        //adding the remaining players to the game (bots)
        for ($i = 0; $i < 9; $i++) {
            shuffle($roles);
            shuffle($names);
            $singlePlayer = Players::create(['game_id' => $gameID, 'user_id' => 0, 'role_id' => array_pop($roles), 'name' => array_pop($names), 'is_bot' => 1]);
        }
        return Redirect::route('game',[$gameID]);
    }
    public function game(Request $request,$id): Response
    {
        error_log($request->user()->id);
        return Inertia::render('Game');
    }
}
