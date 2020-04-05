<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Component as AlpineComponent;

class HomeSearch extends Component
{
    public function render()
    {
        return view('livewire.home-search', [
            'groups' => AlpineComponent::with('creator')->orderBy('category')->orderBy('created_at')->get()->groupBy('category')
        ]);
    }
}
