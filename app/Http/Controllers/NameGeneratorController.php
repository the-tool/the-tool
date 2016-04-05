<?php

/*
 * This file is part of The Tool.
 *
 * (c) CyberCog <support@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

/**
 * Class NameGeneratorController.
 * @package App\Http\Controllers
 */
class NameGeneratorController extends Controller
{
    /**
     * Generate random name.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('name-generator.form');
    }
}
