<?php
declare(strict_types=1);

namespace App\Http\Dto;

use ReflectionClass;

abstract class BaseDto
{
    /**
     * @param array $attributes
     */
    public final function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $this->castValue($value, $key);
            }
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $data = [];

        foreach ($properties as $key => $value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                $data[$key] = $value->toArray();
            } else {
                $data[$key] = $value;
            }
        }

        return $data;
    }

    /**
     * @param array $data
     * @return self
     */
    public final static function fromArray(array $data): self
    {
        return new static($data);
    }

    private function castValue($value, $key)
    {
        $class = static::class;
        $reflector = new ReflectionClass($class);
        $property = $reflector->getProperty($key);
        $type = $property->getType();

        switch ($type->getName()){
            case 'int': return (int)$value;
            case 'bool': return (bool)$value;
        }
//        if ($type && $type->getName() === 'int' && is_numeric($value)) {
//            return (int)$value;
//        }

        return $value;
    }
}
