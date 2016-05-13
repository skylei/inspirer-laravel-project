<?php
/**
 * helpers.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/13 0013 09:54
 */

if (!function_exists('api_success')) {
    /**
     * @param null $body
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    function api_success($body = null)
    {
        return (new \App\Components\Inspirer\Http\ApiHandle($body))->success();
    }
}

if (!function_exists('api_fail')) {
    /**
     * @param       $body
     * @param null  $code
     * @param null  $message
     * @param array $context
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    function api_fail($body, $code = null, $message = null, array $context = [])
    {
        return (new \App\Components\Inspirer\Http\ApiHandle($body))->fail($code, $message, $context);
    }
}

if (!function_exists('response_message')) {
    /**
     * @param       $codeOrName
     * @param array $context
     *
     * @return mixed
     */
    function response_message($codeOrName, $context = [])
    {
        return \App\Components\Inspirer\Http\ApiHandle::getMessage($codeOrName, $context);
    }
}