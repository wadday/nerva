<?php

namespace App\Builders\Menu;

use Illuminate\Support\Facades\Route;

class MenuItem
{
    use ConditionalConcern;

    protected string $name;

    protected string $route;

    protected array $routeParams = [];

    protected ?string $icon = null;

    protected bool $enabled = true;

    protected bool $static = false;

    protected bool $active = false;

    protected ?string $guard = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make(string $name): self
    {
        return new self($name);
    }

    public function setGuard(string $guard): self
    {
        $this->guard = $guard;

        return $this;
    }

    public function getGuard(): ?string
    {
        return $this->guard;
    }

    public function active(string $activeRoute): self
    {
        $current = Route::currentRouteName();

        if (str_starts_with($activeRoute, 'startsWith:')) {
            $prefix = substr($activeRoute, strlen('startsWith:'));
            $this->active = str_starts_with($current, $prefix);
        } else {
            $this->active = $current === $activeRoute;
        }

        return $this;
    }

    public function route(string $route, array $params = []): self
    {
        if (! str_contains($route, '#')) {
            $this->route = route($route, $params);
        } else {
            $this->route = $route;
        }
        $this->routeParams = $params;

        return $this;
    }

    public function icon(string $icon, bool $static = false): self
    {
        $this->icon = $icon;
        $this->static = $static;

        return $this;
    }

    /**
     * @param  string|bool  $permissions  (string: Seperate Permission by comma)
     * @return $this
     */
    public function allows(string|bool $permissions): self
    {
        if (is_bool($permissions)) {
            $this->visible = $permissions;
        } else {
            $this->visible = $this->applyPermission($permissions);
        }

        return $this;
    }

    public function enabled(): self
    {
        $this->enabled = true;

        return $this;
    }

    public function disable(): self
    {
        $this->enabled = false;

        return $this;
    }

    public function toArray(): ?array
    {
        if (! $this->visible) {
            return null;
        }

        return [
            'name' => $this->name,
            'route' => $this->route,
            'route_params' => $this->routeParams,
            'active' => $this->active,
            'icon' => $this->icon,
            'is_enabled' => $this->enabled,
            'is_visible' => $this->visible,
            'static' => $this->static,
        ];

    }

    private function applyPermission(string $permissions): bool
    {
        $auth = auth();
        $user = $auth->user();

        return array_any(explode(',', $permissions), fn ($permit) => $user && $user->can($permit));
    }
}
