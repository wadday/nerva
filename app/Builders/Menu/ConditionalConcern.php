<?php

namespace App\Builders\Menu;

trait ConditionalConcern
{
    protected bool $visible = true;

    public function when(callable $callback): self
    {
        try {
            $this->visible = (bool) $callback($this);
        } catch (\Throwable $e) {
            logger()->error('Error in SidebarItem::when()', [
                'message' => $e->getMessage(),
                'item' => $this,
            ]);
        }

        return $this;
    }
}
