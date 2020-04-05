<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Component as AlpineComponent;

class HomeSearch extends Component
{
    public $allComponents;
    public $sortedComponents;
    public $search;
    public $activeCategories = [];
    public $activeTags = [];

    public function mount()
    {
        $this->allComponents = AlpineComponent::all();
    }

    public function render()
    {
        $facets = $this->allComponents->pluck('category')->countBy()->sort();
        $components = $this->sortedComponents && $this->sortedComponents->count() > 0 ? $this->sortedComponents : $this->allComponents;
        return view('livewire.home-search', [
            'facets' => $facets,
            'activeCategories' => $this->activeCategories,
            'components' => $components
        ]);
    }

    public function updatedSearch()
    {
        $this->searchComponents();
    }


    public function searchComponents()
    {
        $this->sortedComponents = $this->allComponents;

        if ($this->search) {
            $this->sortedComponents = $this->sortedComponents->filter(function ($item) {
                return Str::of($item->summary)->lower()->contains(Str::of($this->search)->lower());
            });
        }

        if (count($this->activeCategories) > 0) {
            $this->sortedComponents =  $this->sortedComponents->filter(function ($item) {
                return in_array($item->category, $this->activeCategories);
            });
        }
    }

    public function updateActiveCategories($category)
    {
        $categories = collect($this->activeCategories);

        if ($categories->contains($category)) {
            $this->activeCategories = $categories->filter(function ($item) use ($category) {
                return $item != $category;
            })->toArray();
        } else {
            $this->activeCategories = $categories->push($category)->toArray();
        }
        $this->searchComponents();
    }
}
