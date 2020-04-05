<div class="container mx-auto">
    <div>
        <div class="flex items-center ml-64 mr-16">
            <input type="text"
                class="w-full p-2 rounded-l"
                placeholder="Search Components ..."
                wire:model="search">
            <button class="h-full p-2 bg-gray-200 rounded-r hover:bg-gray-300"
                wire:click="$set('search','')">X</button>
        </div>
        <div class="fixed right-0 p-4 mr-16 -mt-8 bg-white rounded w-72">
            <h4 class="text-xl font-bold tracking-tighter text-gray-600">Categories</h4>
            @foreach($facets as $facet=>$count)
            <button class="block my-2 ml-4 text-gray-500 hover:underline">{{$facet}} ({{$count}})</button>
            @endforeach
        </div>
    </div>
    <div class="flex mt-2">
        <div class="relative mr-16">
            @foreach($groups as $category => $components)
            <div class="flex pt-2 pb-8 border-t">
                <div class="w-64">
                    <h2 class="text-2xl">{{$category}}</h2>
                </div>
                <div class="flex-1">
                    @foreach ($components as $component)
                    <div
                        class="w-full p-4 {{!$loop->first ? 'mt-8' :''}} bg-white rounded shadow-md border-4 border-transparent hover:border-blue-800">
                        <div class="mb-2>
                            {{$component->summary}}
                        </div>
                        <span class="px-2 py-1 text-xs bg-gray-200 rounded ">{{$component->category}}</span>
                            <div class="mt-4 text-sm ">
                            {{$component->description}}
                        </div>
                        <div class="flex items-center justify-between mt-4 ">
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
                        <button
                            class="px-4 py-2 mr-4 border border-blue-700 rounded hover:bg-blue-700 hover:text-white">
                            View Preview
                        </button>
                        @else
                        <div class="px-4 py-2 mr-4 bg-gray-200 border border-blue-700 rounded">
                            View Preview (Pending)
                        </div>
                        @endif

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
</div>
</div>