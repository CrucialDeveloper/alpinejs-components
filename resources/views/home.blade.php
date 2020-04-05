@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    @foreach($groups as $category => $components)
    <div class="flex pt-8 my-16 border-t">
        <div class="w-64">
            <h2 class="text-3xl">{{$category}}</h2>
        </div>
        <div class="flex-1">
            @foreach ($components as $component)
            <div class="w-full p-4 {{!$loop->first ? 'mt-8' :''}} bg-white rounded shadow-md">
                <div>
                    {{$component->summary}}
                </div>
                <div class="mt-1 text-xs uppercase">{{$component->category}}</div>
                <div class="mt-4 text-sm">
                    {{$component->description}}
                </div>
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center mr-4">
                        <div class="flex items-center justify-center w-8 h-8 mr-4 text-white rounded-full "
                            style=" background:{{$component->creator->background_color}}">
                            {{$component->creator->first_name[0]}}{{$component->creator->last_name[0]}}
                        </div>
                        <span class="text-sm">{{$component->creator->first_name}}
                            {{$component->creator->last_name}}</span>
                    </div>

                    <div class="flex items-center">
                        <button
                            class="px-4 py-2 mr-4 border border-blue-700 rounded hover:bg-blue-700 hover:text-white">
                            View Preview
                        </button>

                        <button class="px-4 py-2 border border-blue-700 rounded hover:bg-blue-700 hover:text-white">
                            View Code
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection