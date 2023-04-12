<?php

namespace App\Service\CQRS;

interface Command
{
    public function id(): string;
}

interface CommandBus
{
    public function dispatch(Command $command): void;
}

interface CommandHandler
{
}