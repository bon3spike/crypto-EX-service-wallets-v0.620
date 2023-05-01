<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Internal\Marshaller\Mapper;

use Spiral\Attributes\ReaderInterface;
use Temporal\Internal\Marshaller\MarshallingRule;
use Temporal\Internal\Marshaller\Meta\Marshal;
use Temporal\Internal\Marshaller\Meta\Scope;
use Temporal\Internal\Marshaller\RuleFactoryInterface;
use Temporal\Internal\Marshaller\Type\TypeInterface;
use Temporal\Internal\Marshaller\TypeFactoryInterface;

/**
 * @psalm-import-type Getter from MapperInterface
 * @psalm-import-type Setter from MapperInterface
 */
class AttributeMapper implements MapperInterface
{
    /**
     * @var \ReflectionClass
     */
    private \ReflectionClass $class;

    /**
     * @var ReaderInterface
     */
    private ReaderInterface $reader;

    /**
     * @var array<string, Getter>
     */
    private array $getters = [];

    /**
     * @var array<string, Setter>
     */
    private array $setters = [];

    /**
     * @var Scope
     */
    private Scope $scope;

    /**
     * @var TypeFactoryInterface
     */
    private TypeFactoryInterface $factory;

    /**
     * @param \ReflectionClass $class
     * @param TypeFactoryInterface $factory
     * @param ReaderInterface $reader
     */
    public function __construct(\ReflectionClass $class, TypeFactoryInterface $factory, ReaderInterface $reader)
    {
        $this->class = $class;
        $this->reader = $reader;
        $this->factory = $factory;
        $this->scope = $this->getScope();

        foreach ($this->getPropertyMappings($this->scope) as $property => $marshal) {
            $type = $this->detectType($property, $marshal);
            $name = $property->getName();

            $this->getters[$marshal->name] = $this->createGetter($name, $type);
            $this->setters[$marshal->name] = $this->createSetter($name, $type);
        }
    }

    /**
     * @return bool
     */
    public function isCopyOnWrite(): bool
    {
        return $this->scope->copyOnWrite;
    }

    /**
     * {@inheritDoc}
     */
    public function getGetters(): iterable
    {
        return $this->getters;
    }

    /**
     * {@inheritDoc}
     */
    public function getSetters(): iterable
    {
        return $this->setters;
    }

    /**
     * @return Scope
     */
    private function getScope(): Scope
    {
        return $this->reader->firstClassMetadata($this->class, Scope::class) ?? new Scope();
    }

    /**
     * Generates property name as key and related {@see MarshallingRule} or {@see null} (if no {@see Marshal}
     * attributes found) as value.
     *
     * @param Scope $scope
     *
     * @return iterable<\ReflectionProperty, MarshallingRule|null>
     */
    private function getPropertyMappings(Scope $scope): iterable
    {
        foreach ($this->class->getProperties() as $property) {
            /** @var Marshal $marshal */
            $marshal = $this->reader->firstPropertyMetadata($property, Marshal::class);

            // Has marshal attribute
            if ($marshal === null && !$this->isValidScope($property, $scope)) {
                continue;
            }

            yield $property => $marshal?->toTypeDto();
        }
    }

    /**
     * @param \ReflectionProperty $property
     * @param Scope $scope
     * @return bool
     */
    private function isValidScope(\ReflectionProperty $property, Scope $scope): bool
    {
        return ($property->getModifiers() & $scope->properties) === $scope->properties;
    }

    /**
     * @param \ReflectionProperty $property
     * @param MarshallingRule|null $rule
     *
     * @return TypeInterface|null
     */
    private function detectType(\ReflectionProperty $property, ?MarshallingRule &$rule): ?TypeInterface
    {
        if ($this->factory instanceof RuleFactoryInterface) {
            $rule ??= $this->factory->makeRule($property);
        }
        $rule ??= new MarshallingRule();
        $rule->name ??= $property->getName();
        $rule->type ??= $this->factory->detect($property->getType());

        if ($rule->type === null) {
            return null;
        }

        return $this->factory->create($rule->type, $rule->of ? [$rule->of] : []);
    }

    /**
     * @param string $name
     * @param TypeInterface|null $type
     * @return \Closure
     */
    private function createGetter(string $name, ?TypeInterface $type): \Closure
    {
        return function () use ($name, $type) {
            try {
                $result = $this->$name;
            } catch (\Error $_) {
                return null;
            }

            return $type && $result !== null ? $type->serialize($result) : $result;
        };
    }

    /**
     * @param string $name
     * @param TypeInterface|null $type
     * @return \Closure
     */
    private function createSetter(string $name, ?TypeInterface $type): \Closure
    {
        return function ($value) use ($name, $type): void {
            try {
                $source = $this->$name;
            } catch (\Error $_) {
                $source = null;
            }

            $this->$name = $type ? $type->parse($value, $source) : $value;
        };
    }
}
