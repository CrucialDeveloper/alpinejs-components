<?php

namespace App\Http\Controllers;

use App\Component;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $component = Component::make($request->all());
        $component->slug = Str::slug($request->slug);

        auth()->user()->components()->save($component);
    }

    public function update(Request $request, Component $component)
    {
        $component->fill($request->all());
        $component->slug = Str::slug($request->summary);

        $component->save();
    }

    public function validateRequest($request)
    {
        $request->validate([
            'summary' => 'required|unique:components',
            'description' => 'required',
            'code' => 'required',
        ]);
    }
}
