@extends('layouts.app')

@section('content')
<div class="container min-h-screen mx-auto bg-white">
    <div class="p-8">
        <h2 class="text-2xl">{{$component->summary}}</h2>
        <p class="mt-2 text-sm text-gray-700">Submitted by {{$component->creator->first_name}}
            {{$component->creator->last_name}}
            {{$component->approved_at ? $component->approved_at->diffForHumans() : "Not Approved"}}</p>
        <p class="mt-4 leading-5 text-gray-700">{{$component->description}}</p>

        <div class="mt-8"
            x-data="iframeComponent()"
            x-init="setHighlight()">
            <div class="flex items-center justify-end">
                <button class="px-4 py-2 mr-8 border border-blue-700 rounded hover:bg-blue-800 hover:text-white"
                    :class="mode !='#code' ? 'bg-blue-700 text-white' : ''"
                    x-on:click="
                    setMode('#preview')">Show Peview</button>
                <button class="px-4 py-2 border border-blue-700 rounded hover:bg-blue-800 hover:text-white"
                    :class="mode === '#code'? 'bg-blue-700 text-white' : ''"
                    x-on:click="setMode('#code')">Show Code</button>
            </div>
            <div class="mt-4 bg-gray-200 rounded h-xl"
                x-show="mode != '#code'">
                <div class="relative max-w-full p-4 overflow-scroll border rounded resize-x resizer h-xl min-w-xs">
                    <iframe class="absolute top-0 left-0 w-full h-full rounded"
                        srcdoc="{{$component->code}}"
                        sandbox="allow-scripts allow-modals allow-same-origin">
                    </iframe>
                </div>
            </div>
            <div class="mt-4"
                x-show="mode === '#code'">
                <pre><code class="rounded">{{$component->code}}</code></pre>
            </div>
        </div>
    </div>
</div>

@push('head')
{{-- <link rel="stylesheet"
    href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/default.min.css"> --}}
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/atom-one-dark.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>
@endpush

@push('scripts')
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

<script>
    function iframeComponent() {
     return {
         mode: window.location.hash,
         setMode(str) {
             window.location.hash = str
             this.mode = str

             if(str === "#code") {
                 this.setHighlight()
             }
         },
         setHighlight() {
             document.querySelectorAll('code').forEach((block) => {
            hljs.highlightBlock(block);
            });
         }
     }
 }
</script>
@endpush

@endsection