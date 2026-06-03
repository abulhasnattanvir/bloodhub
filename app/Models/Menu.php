<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'url',
        'parent_id',
        'sort_order',
        'target_blank',
        'status',
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->where('status', 1)
            ->orderBy('sort_order');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Improved isActive method for nested menus
     */
    public function isActive(): bool
    {
        $currentPath = trim(request()->path(), '/');

        // Check if current menu itself is active
        $menuPath = trim($this->url, '/');

        if ($currentPath === $menuPath || str_starts_with($currentPath, $menuPath . '/')) {
            return true;
        }

        // If this menu has children, check if any child is active
        if ($this->children->count() > 0) {
            foreach ($this->children as $child) {
                $childPath = trim($child->url, '/');
                if ($currentPath === $childPath || str_starts_with($currentPath, $childPath . '/')) {
                    return true;
                }
            }
        }

        return false;
    }
}