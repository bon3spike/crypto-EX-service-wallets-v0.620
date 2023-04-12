<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Worker\Transport\Codec\JsonCodec;

use Temporal\DataConverter\DataConverterInterface;
use Temporal\Exception\Failure\FailureConverter;
use Temporal\Worker\Transport\Command\CommandInterface;
use Temporal\Worker\Transport\Command\FailureResponseInterface;
use Temporal\Worker\Transport\Command\RequestInterface;
use Temporal\Worker\Transport\Command\SuccessResponseInterface;

class Encoder
{
    private const ERROR_INVALID_COMMAND = 'Unserializable command type %s';

    private DataConverterInterface $converter;

    /**
     * @param DataConverterInterface $dataConverter
     */
    public function __construct(DataConverterInterface $dataConverter)
    {
        $this->converter = $dataConverter;
    }

    /**
     * @param CommandInterface $cmd
     * @return array
     */
    public function encode(CommandInterface $cmd): array
    {
        switch (true) {
            case $cmd instanceof RequestInterface:
                $cmd->getPayloads()->setDataConverter($this->converter);

                $options = $cmd->getOptions();
                if ($options === []) {
                    $options = new \stdClass();
                }

                $data = [
                    'id' => $cmd->getID(),
                    'command' => $cmd->getName(),
                    'options' => $options,
                    'payloads' => base64_encode($cmd->getPayloads()->toPayloads()->serializeToString()),
                ];

                if ($cmd->getFailure() !== null) {
                    $failure = FailureConverter::mapExceptionToFailure($cmd->getFailure(), $this->converter);
                    $data['failure'] = base64_encode($failure->serializeToString());
                }

                return $data;

            case $cmd instanceof FailureResponseInterface:
                $failure = FailureConverter::mapExceptionToFailure($cmd->getFailure(), $this->converter);

                return [
                    'id' => $cmd->getID(),
                    'failure' => base64_encode($failure->serializeToString()),
                ];

            case $cmd instanceof SuccessResponseInterface:
                $cmd->getPayloads()->setDataConverter($this->converter);

                return [
                    'id' => $cmd->getID(),
                    'payloads' => base64_encode($cmd->getPayloads()->toPayloads()->serializeToString()),
                ];

            default:
                throw new \InvalidArgumentException(\sprintf(self::ERROR_INVALID_COMMAND, \get_class($cmd)));
        }
    }
}
