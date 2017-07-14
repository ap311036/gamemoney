<?php

/**
 * Created by PhpStorm.
 * User: Magus
 * Date: 2017/4/26
 * Time: 下午6:39
 */
class OdlsPassword
{

    var $showDict;
    var $showChars;
    var $showCharWeight;
    var $passwordWeight;

    function __construct()
    {
        $showChars = ["0", "1", "2", "3", "4", "5",
            "6", "7", "8", "9", "A", "B", "C", "D", "E",
            "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q",
            "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
        $showDict = [];
        $showCharWeight = [1156, 34, 1];
        $passwordWeight = [1, 5, 25, 125, 625, 3125, 15625];


        for ($f = 0; $f < sizeof($showChars); $f++) {

            array_push($showDict, $showChars[$f]);
        }
        $this->showChars = $showChars;
        $this->showDict = $showDict;
        $this->showCharWeight = $showCharWeight;
        $this->passwordWeight = $passwordWeight;
    }


    public function showStringToPassword($p_str) //StringArr
    {
        $p_str = strtoupper($p_str);
        $p_str = str_replace('I', '1', $p_str);
        $p_str = str_replace('O', '0', $p_str);
        if (strlen($p_str) != 3) {
            $log = "字串長度必須為三";
            return $log;
        }
        $arr = [];
        for ($i = 0; $i < strlen($p_str); $i++)
            array_push($arr, mb_substr($p_str, $i, 1));
        $p_str = $arr;
        if (sizeof($p_str) != 3) {
            $log = "字串長度必須為三";
            return $log;
        }

//        int f, _numOriginal, _num, _charNum;

        $_numOriginal = 0;
//        var_dump($this->showDict [$p_str[0]]);
//        var_dump(array_search($p_str[0],$this->showDict));
        for ($f = 0; $f < 3; $f++) {

            $_charNum = (array_search($p_str[$f], $this->showDict));
            if (is_numeric($_charNum)) {
                $_numOriginal += $_charNum * $this->showCharWeight[$f];
            } else {
                $log = ("字串不符合規格,必須為0~9與大寫英文混合");
                return $log;
            }
        }

        $_num = ((($_numOriginal & 0xAAAA)) +
                (($_numOriginal & 0x1) << 14) +
                (($_numOriginal & 0x4) << 10) +
                (($_numOriginal & 0x10) << 6) +
                (($_numOriginal & 0x40) << 2) +
                (($_numOriginal & 0x100) >> 2) +
                (($_numOriginal & 0x400) >> 6) +
                (($_numOriginal & 0x1000) >> 10) +
                (($_numOriginal & 0x4000) >> 14)) ^ 0xAAAA;
        $_passwordChars = [];
        for ($f = 6; $f >= 0; $f--) {
            $_passwordChars[$f] = (int)(($_num / $this->passwordWeight[$f]) + 1);
            $_num = $_num % $this->passwordWeight[$f];
        }

        $_password = $_passwordChars[5] . $_passwordChars[1]
            . $_passwordChars[6] . $_passwordChars[0] . $_passwordChars[3] . $_passwordChars[2] .
            $_passwordChars[4];
//        echo $_password;
        return $_password;
    }


}

