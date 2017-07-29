<?php

/*
 * This file is part of The Tool.
 *
 * (c) Anton Komarev <a.komarev@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

/**
 * Class CharacterConverterController.
 * @package App\Http\Controllers
 */
class CharacterConverterController extends Controller
{
    /**
     * Convert to json.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('character-converter.form');
    }
}
