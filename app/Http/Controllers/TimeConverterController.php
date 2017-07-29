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

use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

/**
 * Class TimeConverterController.
 * @package App\Http\Controllers
 */
class TimeConverterController extends Controller
{
    /**
     * Convert time formats.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $unixTimestamp = Input::get('unix_timestamp');
        $humanTimestamp = Input::get('human_timestamp');

        if (Input::get('unix_to_human')) {
            if (!$unixTimestamp) {
                $unixTimestamp = time();
            }
            $humanTimestamp = Carbon::createFromTimestamp($unixTimestamp);
        } elseif (Input::get('human_to_unix')) {
            $humanTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $humanTimestamp);
            $unixTimestamp = $humanTimestamp->timestamp;
        } else {
            if (!$unixTimestamp) {
                $unixTimestamp = time();
            }
            $humanTimestamp = Carbon::createFromTimestamp($unixTimestamp);
        }

        $timeZone = $humanTimestamp->getTimezone();
        $timeZoneName = $timeZone->getName();
        $timeZoneOffset = $timeZone->getOffset($humanTimestamp);
        $timeZone = $timeZoneName . ' ' . $timeZoneOffset;

        return view('time-converter.form', compact('unixTimestamp', 'humanTimestamp', 'timeZone'));
    }
}
