<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Worker\Environment;

interface EnvironmentInterface
{
    /**
     * @return \DateTimeInterface
     */
    public function now(): \DateTimeInterface;

    /**
     * @return bool
     */
    public function isReplaying(): bool;
}
