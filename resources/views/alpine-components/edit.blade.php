@extends('layouts.app')

@section('content')
<div class="container p-8 mx-auto bg-white">

    <h2 class="text-2xl">Edit Component</h2>

    <form class="mt-8"
        action="/components/{{$component->slug}}"
        method="POST">
        @csrf
        @method('PATCH')

        <div class="flex items-center">
            <label for="summary"
                class="w-32 font-bold text-right min-w-32">Summary</label>
            <input type="text"
                name="summary"
                class="w-full p-2 ml-4 border rounded"
                placeholder="Ex. Select input component"
                value="{{$component->summary}}">
        </div>

        <div class="flex items-start mt-4">
            <label for="description"
                class="w-32 font-bold text-right min-w-32">Description</label>
            <textarea name="description"
                id="description"
                class="w-full p-2 ml-4 border rounded"
                cols="30"
                rows="6"
                placeholder="This component does ..."
        >{{$component->description}}</textarea>
        </div>


        <div class="flex items-start mt-4">
            <label for="category"
                class="w-32 font-bold text-right min-w-32">Category</label>
            <select name="category"
                class="w-full p-2 ml-4 bg-white border rounded"
                id="category">
                <option value="Navigation"
                    {{$component->category === "Navigation" ? 'selected':''}}>Navigation</option>
                <option value="Form Inputs"
                    {{$component->category === "Form Inputs" ? 'selected':''}}>Form Inputs</option>
                <option value="UI Elements"
                    {{$component->category === "UI Elements" ? 'selected':''}}>UI Elements</option>
            </select>
        </div>
        <div class="flex items-start mt-4">
            <label for="code"
                class="w-32 font-bold text-right min-w-32">Code</label>
            <x-code-editor :component="$component"
                field="code"></x-code-editor>
        </div>
        
        <div class="flex items-center justify-end w-full mt-4">
        <a href="/components/{{$component->slug}}" class="mr-8 text-gray-500 hover:underline">Cancel</a>
            <button type="submit"
                class="p-2 text-white bg-blue-500 rounded">Save</button>
        </div>

    </form>

</div>

@endsection
