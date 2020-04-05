<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Component as AlpineComponent;

class HomeSearch extends Component
{
    public $search;
    public $activeCategories = [];
    public $activeTags = [];

    public function render()
    {
        $components = $this->searchComponents();
        $facets = $components->pluck('category')->countBy()->sort();

        return view('livewire.home-search', [
            'facets' => $facets,
            'groups' => $components->sortBy('category')->sortBy('created_at')->groupBy('category')
        ]);
    }

    public function searchComponents()
    {
        return AlpineComponent::search($this->search)->with('creator')->get();
    }
}
