<?php

namespace App\Http\Controllers;

use App\Component;
use Illuminate\Http\Request;

class ComponentPreviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Component $component)
    {
        $this->authorize('preview', $component);
        return view('alpine-components.show');
    }
}
