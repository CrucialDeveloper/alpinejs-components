<?php

namespace App\Http\Controllers;

use App\Component;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ComponentController extends Controller
{
    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('alpine-components.create');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $component = Component::make($request->all());
        $component->slug = Str::slug($request->summary);
        $component->approved_at = Carbon::now();

        auth()->user()->components()->save($component);

        return redirect("/components/$component->slug");
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

        $this->validateRequest($request, $component);
        $component->fill($request->all());
        $component->slug = Str::slug($request->summary);
        $component->save();

        return redirect("/components/$component->slug");
    }

    public function destroy(Component $component)
    {
        $this->authorize('delete', $component);

        $component->delete();

        return redirect('/components');
    }

    public function validateRequest($request, $component = [])
    {
        $request->validate([
            'summary' => ['required', Rule::unique('components', 'summary')->ignore($component)],
            'description' => 'required',
            'code' => 'required',
        ]);
    }
}
