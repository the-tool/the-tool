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

use Illuminate\Http\Request;
use App\Http\Requests;
use Helge\Loader\JsonLoader;
use Helge\Client\SimpleWhoisClient;
use Helge\Service\DomainAvailability;

/**
 * Class WhoisController.
 * @package App\Http\Controllers
 */
class WhoisController extends Controller
{
    /**
     * Resolve WHOIS data for domain.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $domain = $request->input('domain');
        $isAvailable = false;
        $response = '';

        if ($domain) {
            $whoisServersJson = base_path('vendor/helgesverre/domain-availability/src/data/servers.json');
            $whoisClient = new SimpleWhoisClient();
            $dataLoader = new JsonLoader($whoisServersJson);

            $service = new DomainAvailability($whoisClient, $dataLoader);
            $isAvailable = $service->isAvailable($domain);
            $response = $whoisClient->getResponse();
        }

        return view('whois.form', compact('domain', 'isAvailable', 'response'));
    }
}
