<?php

/*
 * This file is part of The Tool.
 *
 * (c) CyberCog <oss@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

/**
 * Class PasswordController.
 * @package App\Http\Controllers
 */
class PasswordController extends Controller
{
    /**
     * Generate random password.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $length = Input::get('length', 15);
        $useLatinCharacters = Input::get('useLatinCharacters', true);
        $useDigitCharacters = Input::get('useDigitCharacters', true);
        $useSymbolCharacters = Input::get('useSymbolCharacters', true);
        $useSafeCharacters = Input::get('useSafeCharacters', true);

        $latinLowerChars = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','x','w','y','z'];
        $latinUpperChars = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','W','Y','Z'];
        $digitChars = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        $symbolChars = ['`','!','"','?','$','?','%','^','&','*','(',')','_','-','+','=','{','[','}',']',':',';','@','\'','~','#','|','\\','<',',','>','.','?','/'];

        if ($useSafeCharacters) {
            $latinLowerChars = ['a','b','c','d','e','f','g','h','i','j','k','m','n','p','q','r','s','t','u','v','x','w','y','z'];
            $latinUpperChars = ['A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','U','V','X','W','Y','Z'];
            $digitChars = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        }

        $characters = [];
        if ($useLatinCharacters) {
            $characters = array_merge($characters, $latinLowerChars, $latinUpperChars);
        }
        if ($useDigitCharacters) {
            $characters = array_merge($characters, $digitChars);
        }
        if ($useDigitCharacters) {
            $characters = array_merge($characters, $digitChars);
        }
        if ($useSymbolCharacters) {
            $characters = array_merge($characters, $symbolChars);
        }

        $password = '';
        if (count($characters) > 0) {
            for ($i = 0; $i < $length; $i++) {
                $password .= $characters[array_rand($characters)];
            }
        }

        return view('password.form',
            [
                'password' => $password,
                'length' => $length,
                'useLatinCharacters' => $useLatinCharacters,
                'useDigitCharacters' => $useDigitCharacters,
                'useSymbolCharacters' => $useSymbolCharacters,
                'useSafeCharacters' => $useSafeCharacters,
            ]
        );
    }
}
