<?php

declare(strict_types=1);

namespace App\Notification\Application\Command;

use App\Application\Command\CommandInterface;

final readonly class ChangeNotificationCommand implements CommandInterface {
    public function __construct(
        public string $_id,
        public string $text,
    )
    {}

    public function id(): string
    {
        return $this->_id;
    }


}