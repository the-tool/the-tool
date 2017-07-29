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

use Illuminate\Support\Facades\Input;
use QueryPath;

/**
 * Class IpBlacklistController.
 * @package App\Http\Controllers
 */
class IpBlacklistController extends Controller
{
    /**
     * Check IP address for present in public blacklists.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $ipAddress = Input::get('ipV4');
        $ipAddress = trim($ipAddress);
        if ($ipAddress == '') {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }

        $checkPerformed = false;
        $inBlacklist = false;
        $blacklistInfoLinks = [];
        $checkerUrl = '';

        if (Input::get('check')) {
            $spamhausBaseUrl = 'http://www.spamhaus.org';
            $checkerUrl = $spamhausBaseUrl . '/query/ip/' . $ipAddress;

            // :TODO: Get with guzzle
            $data = file_get_contents($checkerUrl);
            foreach (qp($data, 'span.body') as $row) {
                $link = $row->find('ul li a')->attr('href');
                if ($link != '') {
                    $blacklistInfoLinks[] = $spamhausBaseUrl . $link;
                }
            }

            if (!empty($blacklistInfoLinks)) {
                $inBlacklist = true;
            }
            $checkPerformed = true;
        }

        return view('ip-blacklist.form',
            [
                'ipV4' => $ipAddress,
                'inBlacklist' => $inBlacklist,
                'blacklistInfoLinks' => $blacklistInfoLinks,
                'checkerUrl' => $checkerUrl,
                'checkPerformed' => $checkPerformed,
            ]
        );
    }
}
