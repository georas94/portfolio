<?php

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $_SERVER['TRUSTED_PROXIES'] = [$_SERVER['REMOTE_ADDR']];
    Request::setTrustedProxies([$_SERVER['REMOTE_ADDR']], Request::HEADER_FORWARDED);
}
return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};