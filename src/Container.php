<?php

namespace dnj\Autounattend;

class Container implements \JsonSerializable
{
    use ExportTrait;

    /**
     * @var object[]
     */
    public $items;

    public ?Attributes\Counter $counter = null;

    /**
     * @param object[] $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @return array<int|string,mixed>
     */
    public function toArray(?string $pass = null): array
    {
        $values = [];
        foreach ($this->items as $item) {
            if (is_object($item)) {
                if ($item instanceof \JsonSerializable) {
                    $item = call_user_func([$item, 'jsonSerialize'], $pass);
                } else {
                    $item = get_object_vars($item);
                }
            }
            $values = $this->merge($values, $item);
        }

        return $values;
    }

    /**
     * @param array<int|string,mixed> $values
     * @param array<string,mixed>     $value
     *
     * @return array<int|string,mixed>
     */
    protected function merge(array $values, array $value): array
    {
        if (1 === count($value)) {
            $key = array_keys($value)[0];
            if (0 !== $key) {
                if (!isset($values[$key])) {
                    $values[$key] = [];
                }
                $values[$key][] = $value[$key];

                return $values;
            }
        }
        $values[] = $value;

        return $values;
    }
}
