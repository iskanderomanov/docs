<?php
declare(strict_types=1);

namespace App\Services;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class ServiceException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    #[Pure] public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
