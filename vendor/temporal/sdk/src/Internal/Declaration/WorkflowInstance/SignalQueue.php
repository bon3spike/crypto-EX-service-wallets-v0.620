<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Internal\Declaration\WorkflowInstance;

use Temporal\DataConverter\ValuesInterface;

/**
 * @psalm-type Consumer = callable(array): mixed
 */
final class SignalQueue
{
    /**
     * @var array<string, array<array>>
     */
    private array $queue = [];

    /**
     * @var array<Consumer>
     */
    private array $consumers = [];

    /**
     * @var callable
     */
    private $onSignal;

    /**
     * @param string $signal
     * @param ValuesInterface $values
     */
    public function push(string $signal, ValuesInterface $values): void
    {
        if (isset($this->consumers[$signal])) {
            ($this->onSignal)(fn () => ($this->consumers[$signal])($values));
            return;
        }

        $this->queue[$signal][] = $values;
        $this->flush($signal);
    }

    /**
     * @param callable $handler
     */
    public function onSignal(callable $handler): void
    {
        $this->onSignal = $handler;
    }

    /**
     * @param string $signal
     * @param Consumer $consumer
     * @return void
     */
    public function attach(string $signal, callable $consumer): void
    {
        $this->consumers[$signal] = $consumer; // overwrite
        $this->flush($signal);
    }

    /**
     * @param string $signal
     * @psalm-suppress UnusedVariable
     */
    private function flush(string $signal): void
    {
        if (!isset($this->queue[$signal], $this->consumers[$signal])) {
            return;
        }

        while ($this->queue[$signal] !== []) {
            $args = \array_shift($this->queue[$signal]);

            ($this->onSignal)(fn () => ($this->consumers[$signal])($args));
        }
    }
}
