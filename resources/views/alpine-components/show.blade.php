@extends('layouts.app')

@section('content')
<div class="container min-h-screen mx-auto bg-white">
    <div class="p-8">
        <h2 class="text-2xl">{{$component->summary}}</h2>
        <p class="mt-2 text-sm">Submitted by {{$component->creator->first_name}}
            {{$component->creator->last_name}}
            {{$component->approved_at->diffForHumans()}}</p>
        <p class="mt-4 leading-5">{{$component->description}}</p>
        <div class="bg-gray-200 h-xl">
            <div class="relative max-w-full p-4 mt-8 overflow-scroll border resize-x resizer h-xl min-w-xs">
                <iframe class="absolute top-0 left-0 w-full h-full"
                    srcdoc="{{$component->code}}"
                    sandbox="allow-scripts allow-modals allow-same-origin">
                </iframe>
            </div>
        </div>
    </div>
</div>

<script>
    let iframe = document.querySelector('iframe')
    iframe.addEventListener('load', function() {
        let tags = iframe.contentDocument.querySelectorAll('a')
        tags.forEach(tag=>{
            tag.addEventListener('click', function(e){
                e.preventDefault()
            })
        })
    })


    
    
 
</script>

@endsection