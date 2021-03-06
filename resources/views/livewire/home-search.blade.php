<div class="container py-8 mx-auto">
    <div class="flex items-start">
        <div class="{{$components->count() ===0 ? 'mr-auto w-full' : 'mr-8 w-full'}}">
            <div class="flex items-center {{$components->count() ===0 ? 'mr-8' : ''}}">
                <input type="text"
                       class="w-full p-2 rounded-l"
                       placeholder="Search Components ..."
                       wire:model="search">
                <button class="h-full p-2 bg-gray-200 rounded-r hover:bg-gray-300"
                        wire:click="$set('search','')">X
                </button>
            </div>
            <div class="flex flex-1">
                <div class="relative w-full {{$components->count() ===0 ? 'mr-8' : ''}}">
                    @if($components->count() ===0)
                        <div
                            class="min-w-full p-4 mt-8 bg-white border-4 border-transparent rounded shadow-md hover:border-blue-800">
                            No components found, try a different search!
                        </div>
                    @endif
                    @foreach ($components as $component)
                        <div
                            class="w-full p-4 mt-8 bg-white border-4 border-transparent rounded shadow-md hover:border-blue-800">
                            <div>
                                {{$component->summary}}
                            </div>
                            <div
                                class="inline-block px-2 py-1 mt-1 text-xs bg-gray-200 rounded">{{$component->category}}</div>
                            <div class="mt-4 text-sm ">
                                {{$component->description}}
                            </div>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center mr-4 ">
                                    <div class="flex items-center justify-center w-8 h-8 mr-4 text-white rounded-full "
                                         style="
                                            background:{{$component->creator->background_color}}">
                                        {{$component->creator->first_name[0]}}{{$component->creator->last_name[0]}}
                                    </div>
                                    <span class="text-sm">{{$component->creator->first_name}}
                                        {{$component->creator->last_name}}</span>
                                </div>

                                <div class="flex items-center">
                                    @if($component->approved_at)
                                        <a href="/components/{{$component->slug}}#preview"
                                           class="px-4 py-2 mr-4 border border-blue-700 rounded hover:bg-blue-700 hover:text-white">
                                            View Preview
                                        </a>
                                    @else
                                        <div class="px-4 py-2 mr-4 bg-gray-200 border border-blue-700 rounded">
                                            View Preview (Pending)
                                        </div>
                                    @endif

                                    <a href="/components/{{$component->slug}}#code"
                                       class="px-4 py-2 border border-blue-700 rounded hover:bg-blue-700 hover:text-white">
                                        View Code
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <div>
                <a href="/components/create"
                   class="block text-center bg-blue-700 rounded text-white p-2 border border-transparent w-full hover:bg-blue-800">Submit
                    a New Component</a>
            </div>
            <div class="p-4 bg-white rounded min-w-64 mt-8">
                <h4 class="text-xl font-bold tracking-tighter text-gray-600">Categories</h4>
                @foreach($facets as $facet=>$count)
                    <button
                        class="block ml-4 mt-2 p-2 hover:underline {{collect($activeCategories)->contains($facet) ? 'bg-gray-600 text-white rounded': 'text-gray-500'}}"
                        wire:click="updateActiveCategories('{{$facet}}')">{{$facet}} ({{$count}})
                    </button>
                @endforeach
            </div>
        </div>
    </div>

</div>
