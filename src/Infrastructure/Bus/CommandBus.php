<?php

namespace App\Infrastructure\Bus;

use App\Application\Command\CommandBusInterface;
use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\CommandInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class CommandBus implements CommandBusInterface
{
    use HandleTrait;


    /**
     * @param iterable<CommandHandlerInterface> $handlers
     *
     */
    public function __construct(
        MessageBusInterface $commandBus, private iterable $handlers )

    {
        $this->messageBus = $commandBus;
    }

    public function execute(CommandInterface $command): void
    {
        foreach ($this->handlers as $handler) {
            if($handler->supports($command)) {
                $handler->handle($command);

                return;
            }
        }

        throw new \RuntimeException('Command handler not registered!');
    }
}