<?php

declare(strict_types=1);

namespace App\Application\Command;

interface CommandHandlerInterface
{
    public function supports(CommandInterface $command): bool;

    public function handle(CommandInterface $command): void;
}