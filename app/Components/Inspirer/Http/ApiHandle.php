<?php
/**
 * ApiHandle.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/12 0012 18:58
 */

namespace App\Components\Inspirer\Http;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;

class ApiHandle implements ApiHandleContract
{
    const SUCCESS_CODE = '000000';

    const SUCCESS_MESSAGE_NAME = 'success';

    const DEFAULT_ERROR_CODE = '900000';

    const DEFAULT_ERROR_HTTP_CODE = 500;

    /**
     * @var null
     */
    protected $body;

    /**
     * @var
     */
    protected static $codeMap = [];

    /**
     * @var
     */
    protected static $apiMessages = [];

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * ApiHandle constructor.
     *
     * @param $body
     */
    public function __construct($body = null)
    {
        $this->body = $body;
    }

    /**
     * @param null $body
     *
     * @return ApiHandle
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param array $map
     */
    public static function codeMap(array $map = [])
    {
        self::$codeMap = array_merge(self::$codeMap, $map);
    }

    /**
     * @param array $messages
     */
    public static function apiMessages(array $messages = [])
    {
        self::$apiMessages = array_merge(self::$apiMessages, $messages);
    }

    /**
     * @return mixed
     */
    public static function getCodeMap()
    {
        return self::$codeMap;
    }

    /**
     * @return mixed
     */
    public static function getApiMessages()
    {
        return self::$apiMessages;
    }

    /**
     * @param $headers
     */
    public function headers($headers)
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * 成功操作接口响应
     *
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\Response
     */
    public function success()
    {
        return new JsonResponse(
            $this->format(self::SUCCESS_CODE, self::SUCCESS_MESSAGE_NAME, $this->body),
            200,
            $this->headers
        );
    }

    /**
     * 失败操作失败响应
     *
     * @param int|string|null $code           响应代码
     * @param int|string|null $message        响应消息
     * @param array           $messageContext 消息上下文
     *
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\Response
     */
    public function fail($code = null, $message = null, array $messageContext = [])
    {
        if (is_null($code)) {
            $code = self::DEFAULT_ERROR_CODE;
        }

        $httpErrorCode = ApiHandle::toHttpStatusCode($code);

        return new JsonResponse(
            $this->format($code, ApiHandle::getMessage($message, $messageContext), $this->body),
            $httpErrorCode,
            $this->headers
        );
    }
    
    /**
     * @param null  $codeOrName
     * @param array $data
     *
     * @return mixed
     */
    public static function getMessage($codeOrName = null, $data = [])
    {
        if (is_null($codeOrName)) {
            $codeOrName = self::$apiMessages[self::DEFAULT_ERROR_CODE];
        } else {
            $codeOrName = isset(self::$apiMessages[$codeOrName]) ? self::$apiMessages[$codeOrName] : $codeOrName;
        }

        return trans(config('app.api-message-trans') . '.api-messages.' . $codeOrName, $data);
    }

    /**
     * @param $code
     *
     * @return int
     */
    public static function toHttpStatusCode($code)
    {
        return isset(self::$codeMap[$code]) ? self::$codeMap[$code] : self::DEFAULT_ERROR_HTTP_CODE;
    }

    /**
     * @param $code
     * @param $message
     * @param $body
     *
     * @return array
     */
    private function format($code, $message, $body)
    {
        if ($body instanceof Arrayable && !$body instanceof \JsonSerializable) {
            $body = $body->toArray();
        }

        return [
            'code'    => $code,
            'message' => $message,
            'body'    => $body,
        ];
    }
}