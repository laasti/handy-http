<?php

namespace Laasti\HandyHttp;

class ResponseHelper extends MessageHelper
{
    /**
     * Is this response empty?
     *
     * @return bool
     */
    public static function isEmpty(ResponseInterface $response)
    {
        return in_array($response->getStatusCode(), [204, 205, 304]);
    }
    /**
     * Is this response informational?
     *
     * @return bool
     */
    public static function isInformational(ResponseInterface $response)
    {
        return $response->getStatusCode() >= 100 && $response->getStatusCode() < 200;
    }
    /**
     * Is this response OK?
     *
     * @return bool
     */
    public static function isOk(ResponseInterface $response)
    {
        return $response->getStatusCode() === 200;
    }
    /**
     * Is this response successful?
     *
     * @return bool
     */
    public static function isSuccessful(ResponseInterface $response)
    {
        return $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
    }
    /**
     * Is this response a redirect?
     *
     * @return bool
     */
    public static function isRedirect(ResponseInterface $response)
    {
        return in_array($response->getStatusCode(), [301, 302, 303, 307]);
    }
    /**
     * Is this response a redirection?
     *
     * @return bool
     */
    public static function isRedirection(ResponseInterface $response)
    {
        return $response->getStatusCode() >= 300 && $response->getStatusCode() < 400;
    }
    /**
     * Is this response forbidden?
     *
     * @return bool
     * @api
     */
    public static function isForbidden(ResponseInterface $response)
    {
        return $response->getStatusCode() === 403;
    }
    /**
     * Is this response not Found?
     *
     * @return bool
     */
    public static function isNotFound(ResponseInterface $response)
    {
        return $response->getStatusCode() === 404;
    }
    /**
     * Is this response a client error?
     *
     * @return bool
     */
    public static function isClientError(ResponseInterface $response)
    {
        return $response->getStatusCode() >= 400 && $response->getStatusCode() < 500;
    }
    /**
     * Is this response a server error?
     *
     * @return bool
     */
    public static function isServerError(ResponseInterface $response)
    {
        return $response->getStatusCode() >= 500 && $response->getStatusCode() < 600;
    }

}
