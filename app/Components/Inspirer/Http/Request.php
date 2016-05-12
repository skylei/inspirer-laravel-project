<?php
/**
 * Request.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/12 0012 15:32
 */

namespace App\Components\Inspirer\Http;

use Illuminate\Http\Request as LaravelRequest;

class Request extends LaravelRequest
{
    /**
     * @return \hisorange\BrowserDetect\Parser
     */
    public function detect()
    {
        return app('browser-detect.parser');
    }
}