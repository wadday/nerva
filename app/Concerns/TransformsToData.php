<?php

namespace App\Concerns;

use App\Attributes\UseData;
use Illuminate\Support\Str;
use ReflectionClass;
use Spatie\LaravelData\Data;

trait TransformsToData
{
    /**
     * Create a new resource object for the given resource.
     *
     * @param  class-string<Data>|null  $dataClass
     */
    public function toData(?string $dataClass = null): Data
    {
        if ($dataClass === null) {
            return $this->guessData();
        }

        return $dataClass::from($this);
    }

    protected function guessData(): Data
    {
        $dataClass = $this->resolveDataFromAttribute(static::class);

        if ($dataClass !== null && class_exists($dataClass)) {
            return $dataClass::from($this);
        }

        foreach (static::guessDataName() as $dataClass) {
            if (is_string($dataClass) && class_exists($dataClass)) {
                return $dataClass::from($this);
            }
        }

        throw new \LogicException(sprintf('Failed to find data class for model [%s].', get_class($this)));
    }

    protected function resolveDataFromAttribute(string $class): ?string
    {
        if (! class_exists($class)) {
            return null;
        }

        $attributes = new ReflectionClass($class)->getAttributes(UseData::class);

        return $attributes !== []
            ? $attributes[0]->newInstance()->class
            : null;
    }

    public static function guessDataName(): array
    {
        $modelClass = static::class;
        if (! Str::contains($modelClass, '\\Models\\')) {
            return [];
        }

        $relativeNamespace = Str::after($modelClass, '\\Models\\');
        $relativeNamespace = Str::contains($relativeNamespace, '\\')
            ? Str::before($relativeNamespace, '\\'.class_basename($modelClass))
            : '';

        $potentialData = sprintf(
            '%s\\Data\\%s%s',
            Str::before($modelClass, '\\Models'),
            strlen($relativeNamespace) > 0 ? $relativeNamespace.'\\' : '',
            class_basename($modelClass)
        );

        return [$potentialData.'Data', $potentialData];
    }
}
