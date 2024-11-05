<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;
use Illuminate\Log\Logger;

class CustomJsonFormatter
{
    /**
     * Customize the given logger instance.
     */
    public function __invoke(Logger $logger): void
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                '{"level":"%level_name%","message":"%message%","context":%context%,"time":"%datetime%"}' . PHP_EOL,
                'Y-m-d H:i:s' 
            ));
        }
    }
}
