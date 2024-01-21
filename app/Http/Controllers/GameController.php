<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Models\GameDb;
use App\Models\GameChat;
use Illuminate\Support\Facades\DB;
use App\Models\Players;

use function Laravel\Prompts\error;

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
        GameDb::where('id', $gameID)->update(['user_role' => $singlePlayer->role_id]);
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
            $BotPlayer = Players::create(['game_id' => $gameID, 'user_id' => 0, 'role_id' => array_pop($roles), 'name' => array_pop($names), 'is_bot' => 1]);
        }
        //adding the message that the game has started
        $message = GameChat::create(['game_id' => $gameID,  'message' => '<b>Game has Started</b>']);


        return Redirect::route('game', [$gameID]);
    }
    public function game(Request $request, $id)
    {
        try {
            $queryResultGame = DB::select('CALL gameinfoget(?, ?)', [$id, $request->user()->id]);
            $resultGame = collect($queryResultGame);
            $queryResultPlayers = DB::select('CALL playersget(?, ?)', [$id, $request->user()->id]);
            $resultPlayers = collect($queryResultPlayers);
            $gamechat =   GameChat::where('game_id', $id)->get();
        } catch (\Illuminate\Database\QueryException $ex) {
            error_log($ex->getMessage());
            // Note any method of class PDOException can be called on $ex.
            return Redirect::route('dashboard');
        }
        if (empty($queryResultGame)) {
            return Redirect::route('dashboard');
        }

        return Inertia::render('Game', ['gameinfo' => $resultGame, 'playersinfo' => $resultPlayers, 'gamechat' => $gamechat]);
    }
    public function gameFlow(Request $request)
    {
        $phase = $request->phase;
        $userRole = (int)$request->userRole;
        $gameID = (int)$request->gameId;
        $userID = (int)$request->userID;
        $selected_player = (int)$request->input('selplayer');

        // error_log($userRole);
        // error_log($gameID);
        // error_log($phase);

        if ($phase == 'day') {

            switch ($userRole) {
                case 4:

                    ///need work
                    $eleminatedPlayerId = array_pop($getSuspects);
                    Players::where('id', $eleminatedPlayerId)->update(['status' => 0]);
                    $eleminatedPlayer = Players::where('id', $eleminatedPlayerId)->first();
                    GameChat::create(['game_id' => $gameID,  'message' => "Villagers have eliminated <b>{$eleminatedPlayer->name}</b>"]);
                    return  Redirect::route('game', [$gameID]);
                    break;
                default:
                    $getSuspects = Players::where(['game_id' => $gameID, 'status' => 1])->pluck('id')->toArray();
                    shuffle($getSuspects);
                    $eleminatedPlayerId = array_pop($getSuspects);
                    Players::where('id', $eleminatedPlayerId)->update(['status' => 0]);
                    $eleminatedPlayer = Players::where('id', $eleminatedPlayerId)->first();
                    GameChat::create(['game_id' => $gameID,  'message' => "Villagers have eliminated <b>{$eleminatedPlayer->name}</b>"]);
                    GameDb::where('id', $gameID)->update(['phase' => 1]);
                    return  Redirect::route('game', [$gameID]);
                    break;
            }
        } else {
            switch ($userRole) {
                    //DETEKTIVI
                case 2:
                    //Mafia eliminate 
                    $getSuspectsForMafia = Players::where([['game_id', '=', $gameID], ['status', '=', 1], ['role_id', '!=', '1']])->pluck('id')->toArray();
                    shuffle($getSuspectsForMafia);
                    $eleminatedPlayerByMafia = array_pop($getSuspectsForMafia);

                    // check if doctor is alive
                    if (Players::where([['game_id', '=', $gameID], ['role_id', '=', '3']])->pluck('status')[0] == 1) {
                        $getPersonDoctor = Players::where([['game_id', '=', $gameID], ['status', '=', 1], ['role_id', '!=', '3']])->pluck('id')->toArray();
                        shuffle($getPersonDoctor);
                        $savedPlayer = array_pop($getPersonDoctor);
                        //Doctor can save the player
                        if ($eleminatedPlayerByMafia == $savedPlayer) {
                            GameChat::create(['game_id' => $gameID,  'message' => "Mafia have tried to eleminate a player but the doctor saved the player"]);
                        } else {
                            //ELEMINATE THE Player
                            Players::where('id', $eleminatedPlayerByMafia)->update(['status' => 0]);
                            $eleminatedPlayer = Players::where('id', $eleminatedPlayerByMafia)->first();
                            GameChat::create(['game_id' => $gameID,  'message' => "Mafia have eliminated <b>{$eleminatedPlayer->name}</b>"]);
                            GameChat::create(['game_id' => $gameID,  'message' => "Doctors have saved a differnt person"]);
                        }
                    } else {
                        Players::where('id', $eleminatedPlayerByMafia)->update(['status' => 0]);
                        $eleminatedPlayer = Players::where('id', $eleminatedPlayerByMafia)->first();
                        GameChat::create(['game_id' => $gameID,  'message' => "Mafia have eliminated <b>{$eleminatedPlayer->name}</b>"]);
                    }
                    //check if detective is alive
                    if (Players::where([['game_id', '=', $gameID], ['user_id', '=', $userID]])->pluck('status')[0] == 1) {
                        //check if selected player is mafia
                        if (Players::where('id', $selected_player)->pluck('role_id')[0] == 1) {
                            Players::where('id', $selected_player)->update(['status' => 0]);
                            $eleminatedPlayer = Players::where('id', $selected_player)->first();
                            GameChat::create(['game_id' => $gameID,  'message' => "Detective have eliminated <b>{$eleminatedPlayer->name}</b>"]);
                        } else {
                            GameChat::create(['game_id' => $gameID,  'message' => "Detective have failed to find the Mafia"]);
                        }
                    }

                    // check if game's over
                    if (Players::where([['game_id', '=', $gameID], ['role_id', '=', '1'], ['status', '=', 1]])->get()->count() == 0) {
                        GameDb::where('id', $gameID)->update(['status' => 0]);
                        GameChat::create(['game_id' => $gameID,  'message' => "<b>Villagers Have Won The Game</b>"]);
                    } else if (Players::where([['game_id', '=', $gameID], ['role_id', '!=', '1'], ['status', '=', 1]])->get()->count() == 0) {
                        GameDb::where('id', $gameID)->update(['status' => 0]);
                        GameChat::create(['game_id' => $gameID,  'message' => "<b>Mafia Have Won The Game</b>"]);
                    }
                    //change phase
                    GameDb::where('id', $gameID)->update(['phase' => 0]);
                    return;
                    break;
                default:
                    $getSuspects = Players::where(['game_id' => $gameID, 'status' => 1])->pluck('id')->toArray();
                    shuffle($getSuspects);
                    $eleminatedPlayerId = array_pop($getSuspects);
                    Players::where('id', $eleminatedPlayerId)->update(['status' => 0]);
                    $eleminatedPlayer = Players::where('id', $eleminatedPlayerId)->first();
                    GameChat::create(['game_id' => $gameID,  'message' => "Villagers have eliminated <b>{$eleminatedPlayer->name}</b>"]);
                    GameDb::where('id', $gameID)->update(['phase' => 1]);
                    return  Redirect::route('game', [$gameID]);
                    break;
            }
        }
    }
}
