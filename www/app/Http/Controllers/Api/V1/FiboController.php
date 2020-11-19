<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\NumberCash;

class FiboController extends Controller
{

    public function index()
    {
        return response()->json([
            'result' => FiboNumbers::all(),
        ]);
    }

    public function handle($number)
    {
        if (is_numeric($number)) {

            $result = $this->getNFibonacci($number);
            $row = new NumberCash;
            $row->number = $result;
            $row->save();
            return response()->json([
                'result' => $result
            ]);
        }
        return response()->json([
            'result' => "NAN",
        ]);
    }
    private function getFibonacciBine($n) {
        $sq5 = sqrt(5);
        $a = (1 + $sq5) / 2;
        $b = (1 - $sq5) / 2;
        return (pow($a, $n) - pow($b, $n)) / $sq5;
    }

    private function getNFibonacci($number) {
        $index = 0;
        $current = [0,0];
        $delta = [9223372036854775807,9223372036854775807];

        while($delta[0]<=$delta[1] && $index<100) {
            $index++;
            $current[1] = $current[0];
            $delta[1] = $delta[0];

            $current[0] = $this->getFibonacciBine($index);
            $delta[0] = abs($current[0]-$number);
        }

        return round($current[1]);
    }

//    private function getFibonacci($n) {
//        $cash = [];
//        $matrixA = [
//            [0, 1],
//            [1, 1],
//        ];
//        $matrixB = [
//            [0, 1],
//            [1, 1],
//        ];
//
//        for ($i = 0; $i < $n-1; $i++) {
//
//            $matrixA[0][0] = $matrixA[0][0] * $matrixB[0][0] + $matrixA[0][1] * $matrixB[1][0];
//            $matrixA[0][1] = $matrixA[0][0] * $matrixB[0][1] + $matrixA[0][1] * $matrixB[1][1];
//
//            $matrixA[1][0] = $matrixA[1][0] * $matrixB[0][0] + $matrixA[1][1] * $matrixB[1][0];
//            $matrixA[1][1] = $matrixA[1][0] * $matrixB[0][1] + $matrixA[1][1] * $matrixB[1][1];
//            $cash[$i] = $matrixA;
//        }
//        return $cash;
//    }



//    private function getNFibonacciBinare($number) {
//        $range = [0,100];
//        $index = 0;
//        $cash = [0,0];
//
//        $stage = 0;
//
//        while ($range[1]-$range[0]>2 && $stage<100) {
//            $stage++;
//
//            $index = round($range[1]-$range[0]/2);
//            $cash[1] = $cash[0];
//            $cash[0] = $this->getFibonacciBine($index);
//
//            if($cash[0]>=$number) {
//                $range[1] = $index;
//            } else {
//                $range[0] = $index;
//            }
//        }
//        return $cash;
//    }
}
