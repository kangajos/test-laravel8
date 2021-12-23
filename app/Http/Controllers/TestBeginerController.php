<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestBeginerController extends Controller
{
    public function duplikat(Request $request)
    {
        if ($request->ajax()) {
            $huruf = $request->abc;
            # jadikan huruf kapital
            $huruf = strtoupper($huruf);
            # jadikan deretan array
            $hurufArray = str_split($huruf);

            $text = "Tidak ada huruf yg duplikat.";
            # looping huruf
            for ($i = 0; $i < count($hurufArray); $i++) {
                $pecahHuruf = explode($hurufArray[$i], $huruf);
                if (count($pecahHuruf) > 2) {
                    $urutan = $i + 1;
                    # jika total pecahan lebi dari 2 maka huruf yg duplikat pertama di temukan
                    $text = "Duplikat huruf ditemukan {$hurufArray[$i]}, pada urutan ke {$urutan} \n";
                    # lalu berhentikan perulangan
                    break;
                }
            }
            return $text;
        }
        return view("beginer.duplikat");
    }

    public function tangga(Request $request)
    {
        if ($request->ajax()) {
            $input = (int) $request->angka;
            $n = [1, 2];
            $data = [];
            for ($i = 0; $i < $input; $i++) {
                for ($x = 0; $x < $input; $x++) {
                    if ($i == 0) {
                        $data[$i][$x] = reset($n);
                    } else {
                        if ($x > 0) {
                            $data[$i][$x] = $i == $x ? end($n) : reset($n);
                        }
                    }
                }
                if ($i + 1 == $input && $input > 3) {
                    for ($k = 0; $k < floor($input / 2); $k++) {
                        $data[$i + 1][$k] = end($n);
                    }
                }
                if ($input % 2 == 1) {
                    $data[$i + 1][$k + 1] = reset($n);
                }
            }

            $result = [];
            foreach ($data as $key => $value) {
                $result[] = "[" . implode(",", $value) . "]";
            }
            if ($result) {
                return "Hasil: ".implode(", ", $result);
            }
            return "-";
        }

        return view("beginer.tangga");
    }
}
