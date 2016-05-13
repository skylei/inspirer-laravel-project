<?php
/**
 * ResponeFactory.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/12 0012 18:54
 */

namespace App\Components\Inspirer\Http;

use Illuminate\Routing\ResponseFactory as LaravelResponseFactory;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Routing\Redirector;

class ResponseFactory extends LaravelResponseFactory
{
    protected $apiHandle;

    public function __construct(ViewFactory $view, Redirector $redirector, ApiHandleContract $apiHandle)
    {
        parent::__construct($view, $redirector);
        
        $this->apiHandle = $apiHandle;
    }
    
    public function api($body)
    {
        $this->apiHandle->setResponseInstance($this);
        
        return $this->apiHandle->setBody($body);
    }
}