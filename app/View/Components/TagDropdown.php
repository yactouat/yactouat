<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class TagDropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $tags = Cache::remember('tags', config('cache.content_cache_duration'), function () {
            return \App\Models\Tag::all()->sortBy('name');
        });
        return view('components.tag-dropdown', [
            'activeTag' => \App\Models\Tag::firstWhere('slug', request('tag')),
            'tags' => $tags
        ]);
    }
}
