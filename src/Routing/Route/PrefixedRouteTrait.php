<?php
namespace App\Routing;

use Cake\Network\Request; // Added at: 2016/3/19 15:27 (JST)
use Cake\Routing\Router;

trait PrefixedRouteTrait
{
    private $prefixes = [
        'admin',
        /* Add your prefixes here */
    ];

    private function getPrefixAndHost(array $context = []) {
        if (empty($context['_host'])) {
            $request = Router::getRequest(true) ?: Request::createFromGlobals();
            $host = $request->host();
        } else {
            $host = $context['_host'];
        }
        $parts = explode('.', $host, 2);
        if (in_array($parts[0], $this->prefixes)) {
            return $parts;
        } else {
            return [false, $host];
        }
    }

    private function checkPrefix($prefix) {
        $routePrefix = isset($this->defaults['prefix']) ? $this->defaults['prefix'] : false;
        return $prefix === $routePrefix;
    }

    public function parse($url) {
        list($prefix) = $this->getPrefixAndHost();
        if (!$this->checkPrefix($prefix)) {
            return false;
        }
        return parent::parse($url);
    }

    public function match(array $url, array $context = []) {
        if (!isset($url['prefix'])) {
            $url['prefix'] = false;
        }
        if (!$this->checkPrefix($url['prefix'])) {
            return false;
        }
        list($prefix, $host) = $this->getPrefixAndHost($context);
        if ($prefix !== $url['prefix']) {
            $url['_host'] = $url['prefix'] === false ? $host : $url['prefix'] . '.' . $host;
        }
        return parent::match($url, $context);
    }
}