<?php

namespace App\Builders\Menu;

use Illuminate\Support\Collection;

class MenuBuilder
{
    use ConditionalConcern;

    protected ?string $guard = null;

    protected Collection $groups;

    protected Collection $items;

    public function __construct()
    {
        $this->items = collect();
        $this->groups = collect();
    }

    public static function make(): self
    {
        return new self;
    }

    public function guard(string $guard): self
    {
        $this->guard = $guard;

        return $this;
    }

    public function group(string $name, array $items): self
    {
        foreach ($items as $item) {
            if ($item instanceof MenuItem && $item->getGuard() === null && $this->guard) {
                $item->setGuard($this->guard);
            }
        }

        $this->groups->push([
            'name' => $name,
            'items' => $items,
        ]);

        return $this;
    }

    public function items(array $items): self
    {
        $this->items->push(...$items);

        return $this;
    }

    public function toArray(): array
    {

        if (! $this->visible) {
            return [];
        }

        if ($this->items->isNotEmpty()) {
            return $this->items
                ->map(fn ($item) => $item->toArray())
                ->filter(fn ($item) => is_array($item) && $item['is_visible'] === true)
                ->toArray();
        }

        return $this->groups->map(function ($group) {
            return [
                'name' => $group['name'],
                'children' => $this->filter(array_map(function (MenuItem $item) {
                    return $item->toArray();
                }, $group['items'])),
            ];
        })->toArray();
    }

    protected function filter(array $items): array
    {
        return collect($items)->filter(fn ($item) => $item && $item['is_visible'] === true)
            ->values()
            ->toArray();
    }
}
