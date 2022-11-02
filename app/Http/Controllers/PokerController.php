<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class PokerController extends Controller
{
    public function placeBet(Request $request) {
        try {
            $input = $request->all();
            $input = preg_split('/\r\n|\r|\n/', $input['bet_info']);
            $testCase = $input[0];

            $results = [];
            for($i=0; $i<$testCase; $i++) {
                $bet = explode(' ', $input[$i+1]);
                $rounds = $bet[1];
                $result = $bet[0];
                for($j=0; $j<$rounds; $j++) {
                    if($result % 2 == 0) {
                        $result = $result - 99;
                        $result = $result * 3;
                        $results[$i] = $this->updateBet($result);
    
                    } else {
                        $result = $result - 15;
                        $result = $result * 2;
                        $results[$i] = $this->updateBet($result);
                    }
                }
            }
            return response()->json([
                'status' => 1,
                'response' => $results
            ]);
        } catch(Exception $e) {
            return response()->json([
                'status' => 0,
                'response' => $results
            ]);
        }
    }


    public function updateBet($result) {
        if($result < 0) {
            $result = $result + 1000000;
        } else if($result > 1000000) {
            $result = $result % 1000000;
        }
        return $result;
    }
}
