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
 * Class ClientController.
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    /**
     * HTTP client detection.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $ipV4 = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        return view('client-info.index',
            [
                'ip_v4' => $ipV4,
                'ua' => $userAgent,
            ]
        );
    }
}
