<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Component as AlpineComponent;

class HomeSearch extends Component
{
    public $allComponents = [];
    public $sortedComponents = [];
    public $search;
    public $activeCategories = [];
    public $activeTags = [];

    public function mount()
    {
        $this->allComponents = AlpineComponent::all();
        $this->sortedComponents = $this->allComponents;
    }

    public function render()
    {
        $facets = $this->allComponents->pluck('category')->countBy()->sort();

        return view('livewire.home-search', [
            'facets' => $facets,
            'activeCategories' => $this->activeCategories,
            'components' => $this->sortedComponents
        ]);
    }

    public function updatedSearch()
    {
        $this->searchComponents();
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

    public function searchComponents()
    {
        $this->sortedComponents = $this->allComponents;
        if (!Str::of($this->search)->isEmpty()) {
            $this->sortedComponents = $this->sortedComponents->filter(function ($item) {
                return Str::of($item->summary)->lower()->contains(Str::of($this->search)->lower()) ||
                    Str::of($item->description)->lower()->contains(Str::of($this->search)->lower());
            });
        } else {
            $this->sortedComponents = $this->allComponents;
        }

        if (count($this->activeCategories) > 0) {
            $this->sortedComponents =  $this->sortedComponents->filter(function ($item) {
                return in_array($item->category, $this->activeCategories);
            });
        }
    }
}
