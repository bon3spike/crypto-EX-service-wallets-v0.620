<?php

namespace App\Infrastructure\Bus;

use App\Application\Query\QueryBusInterface;
use App\Application\Query\QueryHandlerInterface;
use App\Application\Query\QueryInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
final readonly class QueryBus implements QueryBusInterface
{
    use HandleTrait;

    /**
     * @param iterable<QueryHandlerInterface> $handlers
     *
     */
    public function __construct(
        MessageBusInterface $queryBus, private iterable $handlers )

    {
        $this->messageBus = $queryBus;
    }

    public function execute(QueryInterface $query): void
    {
        foreach ($this->handlers as $handler) {
            if($handler->supports($query)) {
                $handler->handle($query);

                return;
            }
        }

        throw new \RuntimeException('Command handler not registered!');
    }

}