<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Internal\Transport;

use React\Promise\PromiseInterface;
use React\Promise\PromisorInterface;

interface CompletableResultInterface extends PromisorInterface, PromiseInterface
{
    /**
     * @return bool
     */
    public function isComplete(): bool;

    /**
     * @return mixed
     */
    public function getValue();
}
