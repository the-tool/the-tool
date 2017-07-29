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
use RomanPitak\Nginx\Config\Directive;
use RomanPitak\Nginx\Config\Scope;

/**
 * Class NginxConfigController.
 * @package App\Http\Controllers
 */
class NginxConfigController extends Controller
{
    public function create()
    {
        return view('nginx.config.create');
    }

    public function store(Request $request)
    {
        $outputFilePath = storage_path('out.conf');

        // Laravel specific
        $appPublicDirectory = 'public';

        $domain = $request->input('domain');
        $scheme = parse_url($domain, PHP_URL_SCHEME);
        $mainHost = parse_url($domain, PHP_URL_HOST);

        $secondaryHosts = $request->input('domains_secondary');
        if ($secondaryHosts) {
            $serverNames = implode(' ', [$mainHost, $secondaryHosts]);
        } else {
            $serverNames = $mainHost;
        }

        $domainParts = explode('.', $mainHost);
        // :TODO: What if < 3 parts?
        $appZoneDirectory = array_pop($domainParts);
        $appDomainDirectory = array_pop($domainParts);
        $appSubDomainDirectory = array_pop($domainParts);

        $rewriteEndSlash = boolval($request->input('rewrite_end_slash'));

        $ipAddress = '127.0.0.1';
        $port = 80;
        $serverBasePath = '/var/www';
        $serverDomainPath = sprintf('%s/%s/%s', $serverBasePath, $appZoneDirectory, $appDomainDirectory);
        $rootPath = sprintf('%s/%s/%s', $serverDomainPath, $appSubDomainDirectory, $appPublicDirectory);
        $mainUrl = sprintf('%s://%s', $scheme, $mainHost);
        $accessLogPath = sprintf('%s/.log/%s/nginx.access.log', $serverDomainPath, $appSubDomainDirectory);
        $accessLogLevel = 'main';
        $errorLogPath = sprintf('%s/.log/%s/nginx.error.log', $serverDomainPath, $appSubDomainDirectory);
        $errorLogLevel = 'info';
        $fastCgiHost = '127.0.0.1';
        $fastCgiPort = $request->input('fast_cgi_port', 9000);
        $fastCgiListener = sprintf('%s:%s', $fastCgiHost, $fastCgiPort);
        $fastCgiIndex = 'index.php';
        $fastCgiParam = 'SCRIPT_FILENAME $document_root$fastcgi_script_name';
        $clientMaxBodySize = '8m';
        $clientBodyBufferSize = '128k';
        $listen = sprintf('%s:%s', $ipAddress, $port);

        $serverData = Scope::create()
            ->addDirective(Directive::create('listen', $listen))
            ->addDirective(Directive::create('server_name', $serverNames));

        if ($secondaryHosts != '') {
            // :TODO: Explode $secondaryHosts to several conditionals
            $serverData->addDirective(
                Directive::create(
                    'if', sprintf('($http_host = %s)', $secondaryHosts),
                    Scope::create()->addDirective(
                        Directive::create('rewrite', sprintf('(.*) %s$1 permanent', $mainUrl))
                    )
                )
            );
        }

        $serverData
            ->addDirective(Directive::create('access_log', sprintf('%s %s', $accessLogPath, $accessLogLevel)))
            ->addDirective(Directive::create('error_log', sprintf('%s %s', $errorLogPath, $errorLogLevel)))
            ->addDirective(Directive::create('root', $rootPath));

        $serverData
            ->addDirective(Directive::create('client_max_body_size', $clientMaxBodySize))
            ->addDirective(Directive::create('client_body_buffer_size', $clientBodyBufferSize));

        if ($rewriteEndSlash) {
            $serverData->addDirective(Directive::create('rewrite', '^/(.*)/$ /$1 permanent'));
        }

        $serverData->addDirective(Directive::create(
            'location',
            '/',
            Scope::create()
                ->addDirective(Directive::create('index', 'index.php index.html index.htm'))
                ->addDirective(Directive::create('try_files', '$uri $uri/ /index.php?$query_string'))
        ));

        $serverData->addDirective(Directive::create(
            'location', '~ \.php$',
            Scope::create()
                ->addDirective(Directive::create('include', 'fastcgi_params'))
                ->addDirective(Directive::create('fastcgi_pass', $fastCgiListener))
                ->addDirective(Directive::create('fastcgi_index', $fastCgiIndex))
                ->addDirective(Directive::create('fastcgi_param', $fastCgiParam))
        ));

        $config = Scope::create();
        $config->addDirective(Directive::create('server')->setChildScope($serverData));

        if ($request->input('print') || true) {
            $output = $config->prettyPrint(-1);

            return "<pre>{$output}</pre>";
        }

        //$config->saveToFile($outputFilePath);
    }
}
