<?php

namespace Symfony\Config\JmsSerializer;

require_once __DIR__.\DIRECTORY_SEPARATOR.'InstancesConfig'.\DIRECTORY_SEPARATOR.'HandlersConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'InstancesConfig'.\DIRECTORY_SEPARATOR.'SubscribersConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'InstancesConfig'.\DIRECTORY_SEPARATOR.'ObjectConstructorsConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'InstancesConfig'.\DIRECTORY_SEPARATOR.'PropertyNamingConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'InstancesConfig'.\DIRECTORY_SEPARATOR.'ExpressionEvaluatorConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'InstancesConfig'.\DIRECTORY_SEPARATOR.'MetadataConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'InstancesConfig'.\DIRECTORY_SEPARATOR.'VisitorsConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'InstancesConfig'.\DIRECTORY_SEPARATOR.'DefaultContextConfig.php';

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class InstancesConfig 
{
    private $inherit;
    private $enumSupport;
    private $handlers;
    private $subscribers;
    private $objectConstructors;
    private $propertyNaming;
    private $expressionEvaluator;
    private $metadata;
    private $visitors;
    private $defaultContext;
    private $_usedProperties = [];

    /**
     * @default false
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function inherit($value): static
    {
        $this->_usedProperties['inherit'] = true;
        $this->inherit = $value;

        return $this;
    }

    /**
     * @default false
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function enumSupport($value): static
    {
        $this->_usedProperties['enumSupport'] = true;
        $this->enumSupport = $value;

        return $this;
    }

    /**
     * @default {"datetime":{"default_format":"Y-m-d\\TH:i:sP","default_timezone":"UTC","cdata":true},"array_collection":{"initialize_excluded":false},"symfony_uid":{"default_format":"canonical","cdata":true}}
    */
    public function handlers(array $value = []): \Symfony\Config\JmsSerializer\InstancesConfig\HandlersConfig
    {
        if (null === $this->handlers) {
            $this->_usedProperties['handlers'] = true;
            $this->handlers = new \Symfony\Config\JmsSerializer\InstancesConfig\HandlersConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "handlers()" has already been initialized. You cannot pass values the second time you call handlers().');
        }

        return $this->handlers;
    }

    /**
     * @default {"doctrine_proxy":{"initialize_excluded":false,"initialize_virtual_types":false}}
    */
    public function subscribers(array $value = []): \Symfony\Config\JmsSerializer\InstancesConfig\SubscribersConfig
    {
        if (null === $this->subscribers) {
            $this->_usedProperties['subscribers'] = true;
            $this->subscribers = new \Symfony\Config\JmsSerializer\InstancesConfig\SubscribersConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "subscribers()" has already been initialized. You cannot pass values the second time you call subscribers().');
        }

        return $this->subscribers;
    }

    /**
     * @default {"doctrine":{"enabled":true,"fallback_strategy":"null"}}
    */
    public function objectConstructors(array $value = []): \Symfony\Config\JmsSerializer\InstancesConfig\ObjectConstructorsConfig
    {
        if (null === $this->objectConstructors) {
            $this->_usedProperties['objectConstructors'] = true;
            $this->objectConstructors = new \Symfony\Config\JmsSerializer\InstancesConfig\ObjectConstructorsConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "objectConstructors()" has already been initialized. You cannot pass values the second time you call objectConstructors().');
        }

        return $this->objectConstructors;
    }

    /**
     * @template TValue
     * @param TValue $value
     * @default {"separator":"_","lower_case":true}
     * @return \Symfony\Config\JmsSerializer\InstancesConfig\PropertyNamingConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\JmsSerializer\InstancesConfig\PropertyNamingConfig : static)
     */
    public function propertyNaming(string|array $value = []): \Symfony\Config\JmsSerializer\InstancesConfig\PropertyNamingConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['propertyNaming'] = true;
            $this->propertyNaming = $value;

            return $this;
        }

        if (!$this->propertyNaming instanceof \Symfony\Config\JmsSerializer\InstancesConfig\PropertyNamingConfig) {
            $this->_usedProperties['propertyNaming'] = true;
            $this->propertyNaming = new \Symfony\Config\JmsSerializer\InstancesConfig\PropertyNamingConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "propertyNaming()" has already been initialized. You cannot pass values the second time you call propertyNaming().');
        }

        return $this->propertyNaming;
    }

    /**
     * @template TValue
     * @param TValue $value
     * @default {"id":null}
     * @return \Symfony\Config\JmsSerializer\InstancesConfig\ExpressionEvaluatorConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\JmsSerializer\InstancesConfig\ExpressionEvaluatorConfig : static)
     */
    public function expressionEvaluator(string|array $value = []): \Symfony\Config\JmsSerializer\InstancesConfig\ExpressionEvaluatorConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['expressionEvaluator'] = true;
            $this->expressionEvaluator = $value;

            return $this;
        }

        if (!$this->expressionEvaluator instanceof \Symfony\Config\JmsSerializer\InstancesConfig\ExpressionEvaluatorConfig) {
            $this->_usedProperties['expressionEvaluator'] = true;
            $this->expressionEvaluator = new \Symfony\Config\JmsSerializer\InstancesConfig\ExpressionEvaluatorConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "expressionEvaluator()" has already been initialized. You cannot pass values the second time you call expressionEvaluator().');
        }

        return $this->expressionEvaluator;
    }

    /**
     * @default {"warmup":{"paths":{"included":[],"excluded":[]}},"cache":"file","debug":true,"file_cache":{"dir":null},"include_interfaces":false,"auto_detection":true,"infer_types_from_doc_block":false,"infer_types_from_doctrine_metadata":true,"directories":[]}
    */
    public function metadata(array $value = []): \Symfony\Config\JmsSerializer\InstancesConfig\MetadataConfig
    {
        if (null === $this->metadata) {
            $this->_usedProperties['metadata'] = true;
            $this->metadata = new \Symfony\Config\JmsSerializer\InstancesConfig\MetadataConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "metadata()" has already been initialized. You cannot pass values the second time you call metadata().');
        }

        return $this->metadata;
    }

    /**
     * @default {"json_serialization":{"options":1024},"json_deserialization":{"options":0,"strict":false},"xml_serialization":{"format_output":false,"default_root_ns":""},"xml_deserialization":{"doctype_whitelist":[],"external_entities":false,"options":0}}
    */
    public function visitors(array $value = []): \Symfony\Config\JmsSerializer\InstancesConfig\VisitorsConfig
    {
        if (null === $this->visitors) {
            $this->_usedProperties['visitors'] = true;
            $this->visitors = new \Symfony\Config\JmsSerializer\InstancesConfig\VisitorsConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "visitors()" has already been initialized. You cannot pass values the second time you call visitors().');
        }

        return $this->visitors;
    }

    /**
     * @default {"serialization":{"attributes":[],"groups":[]},"deserialization":{"attributes":[],"groups":[]}}
    */
    public function defaultContext(array $value = []): \Symfony\Config\JmsSerializer\InstancesConfig\DefaultContextConfig
    {
        if (null === $this->defaultContext) {
            $this->_usedProperties['defaultContext'] = true;
            $this->defaultContext = new \Symfony\Config\JmsSerializer\InstancesConfig\DefaultContextConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "defaultContext()" has already been initialized. You cannot pass values the second time you call defaultContext().');
        }

        return $this->defaultContext;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('inherit', $value)) {
            $this->_usedProperties['inherit'] = true;
            $this->inherit = $value['inherit'];
            unset($value['inherit']);
        }

        if (array_key_exists('enum_support', $value)) {
            $this->_usedProperties['enumSupport'] = true;
            $this->enumSupport = $value['enum_support'];
            unset($value['enum_support']);
        }

        if (array_key_exists('handlers', $value)) {
            $this->_usedProperties['handlers'] = true;
            $this->handlers = new \Symfony\Config\JmsSerializer\InstancesConfig\HandlersConfig($value['handlers']);
            unset($value['handlers']);
        }

        if (array_key_exists('subscribers', $value)) {
            $this->_usedProperties['subscribers'] = true;
            $this->subscribers = new \Symfony\Config\JmsSerializer\InstancesConfig\SubscribersConfig($value['subscribers']);
            unset($value['subscribers']);
        }

        if (array_key_exists('object_constructors', $value)) {
            $this->_usedProperties['objectConstructors'] = true;
            $this->objectConstructors = new \Symfony\Config\JmsSerializer\InstancesConfig\ObjectConstructorsConfig($value['object_constructors']);
            unset($value['object_constructors']);
        }

        if (array_key_exists('property_naming', $value)) {
            $this->_usedProperties['propertyNaming'] = true;
            $this->propertyNaming = \is_array($value['property_naming']) ? new \Symfony\Config\JmsSerializer\InstancesConfig\PropertyNamingConfig($value['property_naming']) : $value['property_naming'];
            unset($value['property_naming']);
        }

        if (array_key_exists('expression_evaluator', $value)) {
            $this->_usedProperties['expressionEvaluator'] = true;
            $this->expressionEvaluator = \is_array($value['expression_evaluator']) ? new \Symfony\Config\JmsSerializer\InstancesConfig\ExpressionEvaluatorConfig($value['expression_evaluator']) : $value['expression_evaluator'];
            unset($value['expression_evaluator']);
        }

        if (array_key_exists('metadata', $value)) {
            $this->_usedProperties['metadata'] = true;
            $this->metadata = new \Symfony\Config\JmsSerializer\InstancesConfig\MetadataConfig($value['metadata']);
            unset($value['metadata']);
        }

        if (array_key_exists('visitors', $value)) {
            $this->_usedProperties['visitors'] = true;
            $this->visitors = new \Symfony\Config\JmsSerializer\InstancesConfig\VisitorsConfig($value['visitors']);
            unset($value['visitors']);
        }

        if (array_key_exists('default_context', $value)) {
            $this->_usedProperties['defaultContext'] = true;
            $this->defaultContext = new \Symfony\Config\JmsSerializer\InstancesConfig\DefaultContextConfig($value['default_context']);
            unset($value['default_context']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['inherit'])) {
            $output['inherit'] = $this->inherit;
        }
        if (isset($this->_usedProperties['enumSupport'])) {
            $output['enum_support'] = $this->enumSupport;
        }
        if (isset($this->_usedProperties['handlers'])) {
            $output['handlers'] = $this->handlers->toArray();
        }
        if (isset($this->_usedProperties['subscribers'])) {
            $output['subscribers'] = $this->subscribers->toArray();
        }
        if (isset($this->_usedProperties['objectConstructors'])) {
            $output['object_constructors'] = $this->objectConstructors->toArray();
        }
        if (isset($this->_usedProperties['propertyNaming'])) {
            $output['property_naming'] = $this->propertyNaming instanceof \Symfony\Config\JmsSerializer\InstancesConfig\PropertyNamingConfig ? $this->propertyNaming->toArray() : $this->propertyNaming;
        }
        if (isset($this->_usedProperties['expressionEvaluator'])) {
            $output['expression_evaluator'] = $this->expressionEvaluator instanceof \Symfony\Config\JmsSerializer\InstancesConfig\ExpressionEvaluatorConfig ? $this->expressionEvaluator->toArray() : $this->expressionEvaluator;
        }
        if (isset($this->_usedProperties['metadata'])) {
            $output['metadata'] = $this->metadata->toArray();
        }
        if (isset($this->_usedProperties['visitors'])) {
            $output['visitors'] = $this->visitors->toArray();
        }
        if (isset($this->_usedProperties['defaultContext'])) {
            $output['default_context'] = $this->defaultContext->toArray();
        }

        return $output;
    }

}
