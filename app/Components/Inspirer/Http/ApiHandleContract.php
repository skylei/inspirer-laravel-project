<?php
/**
 * ApiHandleContract.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/12 0012 18:59
 */

namespace App\Components\Inspirer\Http;

/**
 * Interface ApiHandleContract
 *
 * @package App\Components\Inspirer\Http
 */
interface ApiHandleContract
{
    /**
     * 成功操作接口响应
     *
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\Response
     */
    public function success();

    /**
     * 失败操作失败响应
     *
     * @param int|string|null $code    响应代码
     * @param int|string|null $message 响应消息
     *
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\Response
     */
    public function fail($code = null, $message = null);

    /**
     * 设置响应实例
     * 
     * @param ResponseFactory $response
     *
     * @return void
     */
    public function setResponseInstance($response);
}