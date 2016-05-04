<?php

namespace App\Components\UserSystem\AdministratorModules;

use App\Components\UserSystem\Administrator;
use Illuminate\Database\Eloquent\Model;
use Psr\Log\LoggerInterface;

/**
 * Class AdminOperationalLog
 *
 * @package App\Components\UserSystem\AdministratorModules
 */
class AdminOperationalLog extends Model implements LoggerInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operator()
    {
        return $this->belongsTo(Administrator::class, 'operator_id', 'id');
    }

    /**
     * @param                    $level
     * @param                    $message
     * @param array              $context
     * @param Administrator|null $operator
     *
     * @return AdminOperationalLog
     */
    public function addLog($level, $message, array $context = [], Administrator $operator = null)
    {
        $log = new self;

        if (is_null($operator)) {
            $operator = \Auth::guard('admin')->user();
        }

        $log->operator()->associate($operator);
        $log->setLevel($level)->setMessage($message, $context)->save();

        return $log;
    }

    /**
     * @param $level
     *
     * @return $this
     */
    public function setLevel($level)
    {
        $this->level = $level;
        
        return $this;
    }

    /**
     * @param       $message
     * @param array $context
     *
     * @return $this
     */
    public function setMessage($message, array $context = [])
    {
        $this->message = vsprintf($message, $context);

        return $this;
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return AdminOperationalLog
     */
    public function emergency($message, array $context = array())
    {
        return $this->addLog('emergency', $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return AdminOperationalLog
     */
    public function alert($message, array $context = array())
    {
        return $this->addLog('alert', $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return AdminOperationalLog
     */
    public function critical($message, array $context = array())
    {
        return $this->addLog('critical', $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return AdminOperationalLog
     */
    public function error($message, array $context = array())
    {
        return $this->addLog('error', $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return AdminOperationalLog
     */
    public function warning($message, array $context = array())
    {
        return $this->addLog('warning', $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return AdminOperationalLog
     */
    public function notice($message, array $context = array())
    {
        return $this->addLog('notice', $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return AdminOperationalLog
     */
    public function info($message, array $context = array())
    {
        return $this->addLog('info', $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return AdminOperationalLog
     */
    public function debug($message, array $context = array())
    {
        return $this->addLog('debug', $message, $context);
    }

    /**
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return AdminOperationalLog
     */
    public function log($level, $message, array $context = array())
    {
        return $this->addLog('log', $message, $context);
    }

}
