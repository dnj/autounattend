<?php

namespace dnj\Autounattend;

use ReflectionClass;
use ReflectionProperty;

trait ExportTrait
{
    /**
     * @var array<string,mixed>
     */
    public array $_attributes = [];

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    protected function normalize(?string $pass, $value)
    {
        $isNumericArray = fn ($value) => array_keys($value) === range(0, count($value) - 1);
        $appendInValue = function (array &$target, string $key, $value) use ($isNumericArray) {
            if (isset($target[$key])) {
                if (is_array($target[$key]) and $isNumericArray($target[$key])) {
                    $target[$key][] = $value;
                } else {
                    $target[$key] = [$target[$key], $value];
                }
            } else {
                $target[$key] = $value;
            }
        };

        if (is_bool($value)) {
            $value = $value ? 'true' : 'false';
        }
        while (is_object($value)) {
            if ($value instanceof \JsonSerializable) {
                $value = call_user_func([$value, 'jsonSerialize'], $pass);
            } else {
                $value = get_object_vars($value);
            }
        }
        if (!is_array($value)) {
            return $value;
        }

        $newValue = [];
        foreach ($value as $k => $v) {
            if ((in_array(substr($k, 0, 1), ['_']))) {
                continue;
            }
            $result = $this->normalize($pass, $v);

            if (null === $result) {
                continue;
            }
            $appendInValue($newValue, $k, $result);
        }

        return $newValue;
    }

    /**
     * @return ReflectionProperty[]
     */
    protected function getPropertiesForPass(?string $pass): array
    {
        $class = new ReflectionClass(get_class($this));
        $properties = $class->getProperties(ReflectionProperty::IS_PUBLIC);
        if (null === $pass) {
            return $properties;
        }

        return array_filter($properties, function ($property) use ($pass) {
            if ('_' === $property->getName()[0] or null === $this->{$property->getName()}) {
                return false;
            }
            $passAttr = $property->getAttributes(Attributes\Pass::class)[0] ?? null;
            if (!$passAttr) {
                return true;
            }
            /**
             * @var Attributes\Pass
             */
            $passAttr = $passAttr->newInstance();

            return in_array($pass, $passAttr->getNames());
        });
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(string $pass = null): array
    {
        $data = [];
        foreach ($this->getPropertiesForPass($pass) as $property) {
            $name = ucfirst($property->getName());
            $value = $this->{$property->getName()};
            foreach ($property->getAttributes() as $attribute) {
                if (Attributes\Container::class == $attribute->getName()) {
                    $value = new Container($value);
                } elseif (Attributes\Cast::class == $attribute->getName()) {
                    /**
                     * @var Attributes\Cast
                     */
                    $instace = $attribute->newInstance();
                    $target = $instace->getTarget();
                    $value = new $target($value);
                } elseif (Attributes\EachCast::class == $attribute->getName()) {
                    /**
                     * @var Attributes\EachCast
                     */
                    $instace = $attribute->newInstance();
                    $target = $instace->getTarget();
                    $value = array_map(fn ($item) => new $target($item), $value);
                } elseif (Attributes\Name::class == $attribute->getName()) {
                    /**
                     * @var Attributes\Name
                     */
                    $instace = $attribute->newInstance();
                    $name = $instace->getName();
                } elseif (Attributes\Counter::class == $attribute->getName()) {
                    /**
                     * @var Attributes\Counter
                     */
                    $instace = $attribute->newInstance();
                    $counterName = $instace->getName();
                    $counterStart = $instace->getStart();
                    $counterValue = 0;
                    foreach ($value as &$item) {
                        $item->_attributes[$counterName] = $counterValue + $counterStart;
                        ++$counterValue;
                    }
                }
            }
            $data[$name] = $value;
        }

        $data = array_replace($data, $this->toArrayClass());
        $data = $this->wrapClass($data);

        return $data;
    }

    /**
     * @return array<string,mixed>
     */
    protected function toArrayClass(): array
    {
        $data = [];

        $class = new ReflectionClass(get_class($this));
        if (!isset($this->_attributes)) {
            $this->_attributes = [];
        }
        foreach ($class->getAttributes() as $attribute) {
            if (Attributes\Attribute::class == $attribute->getName()) {
                /**
                 * @var Attributes\Attribute
                 */
                $instance = $attribute->newInstance();
                $attributeName = $instance->getName();
                if (isset($this->_attributes['@'.$attributeName])) {
                    continue;
                }
                $this->_attributes['@'.$attributeName] = $instance->getValue();
            }
        }
        /**
         * @var string $key
         */
        foreach ($this->_attributes as $key => $value) {
            $data[$key] = $value;
        }

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     *
     * @return array<string,mixed>
     */
    protected function wrapClass(array $data): array
    {
        $class = new ReflectionClass(get_class($this));

        $order = $class->getAttributes(Attributes\Order::class)[0] ?? null;
        if ($order) {
            /**
             * @var Attributes\Order
             */
            $order = $order->newInstance();
            $fields = $order->getFields();

            uksort($data, function ($a, $b) use ($fields) {
                return intval(array_search($a, $fields)) - intval(array_search($b, $fields));
            });
        }

        $wrapper = $class->getAttributes(Attributes\Wrapper::class)[0] ?? null;
        if ($wrapper) {
            /**
             * @var Attributes\Wrapper $wrapper
             */
            $wrapper = $wrapper->newInstance();
            $name = $wrapper->getName() ?? $class->getShortName();
            $data = [$name => $data];
        }

        return $data;
    }

    public function jsonSerialize(string $pass = null)
    {
        return $this->normalize($pass, $this->toArray($pass));
    }
}
