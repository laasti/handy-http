<?php

namespace Laasti\HandyHttp;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;

class RequestHelper extends MessageHelper
{

    public static function isXhr(RequestInterface $request)
    {
        return $request->getHeaderLine('X-Requested-With') === 'XMLHttpRequest';
    }

    public static function getParam(ServerRequestInterface $request, $key, $default = null)
    {
        $postParams = $request->getParsedBody();
        $getParams = $request->getQueryParams();

        if (is_array($postParams) && isset($postParams[$key])) {
            return $postParams[$key];
        } elseif (is_object($postParams) && property_exists($postParams, $key)) {
            return $postParams->$key;
        } elseif (isset($getParams[$key])) {
            return $getParams[$key];
        }
        return $default;
    }

    public static function getBasePath(ServerRequestInterface $request)
    {
        $server = $request->getServerParams();
        $folder = '';
        if (isset($server['SCRIPT_NAME'])) {
            $folder = pathinfo($server['SCRIPT_NAME'], PATHINFO_DIRNAME);
        } else if (isset($server['PHP_SELF'])) {
            $folder = pathinfo($server['PHP_SELF'], PATHINFO_DIRNAME);
        }
        return $folder;
    }

    public static function getBaseUrl(RequestInterface $request)
    {
        $uri = $request->getUri()->withPath(self::getBasePath($request));

        return (string) $uri;
    }
    
    public static function withBasePath(RequestInterface $request, $path)
    {
        $uri = $request->getUri()->withPath($path.self::getRelativePath($request));
        return $request->withUri($uri);
    }

    public static function getRelativePath(RequestInterface $request)
    {
        return str_replace(self::getBasePath($request), '', $request->getUri()->getPath());
    }

    public static function withRelativePath(RequestInterface $request, $path)
    {
        $uri = $request->getUri()->withPath(self::getBasePath($request).$path);
        return $request->withUri($uri);
    }
}
