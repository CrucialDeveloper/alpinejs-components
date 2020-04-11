<?php

namespace App\Http\Controllers;

use App\Component;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComponentController extends Controller
{
    public function create()
    {
        return view('alpine-components.create');
    }


    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $component = Component::make($request->all());
        $component->slug = Str::slug($request->summary);
        $component->approved_at = Carbon::now();

        auth()->user()->components()->save($component);
    }

    /**
     * @param Request $request
     * @param Component $component
     * @return Factory|View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Component $component)
    {
        $this->authorize('preview', $component);
        return view('alpine-components.show', [
            'component' => $component->load('creator')
        ]);
    }

    public function edit(Component $component)
    {
        return view('alpine-components.edit', [
            'component' => $component
        ]);
    }

    public function update(Request $request, Component $component)
    {
        $this->authorize('update', $component);

        $this->validateRequest($request);
        $component->fill($request->all());
        $component->slug = Str::slug($request->summary);
        $component->save();

        return redirect("/components/$component->slug");
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
