@extends('layouts.app')

@section('content')
<div class="container mx-auto bg-white">
    <div class="p-8">
        <h2 class="text-2xl">{{$component->summary}}</h2>
        <p class="mt-2 text-sm text-gray-700">Submitted by {{$component->creator->first_name}}
            {{$component->creator->last_name}}
            {{$component->approved_at ? $component->approved_at->diffForHumans() : "Not Approved"}}</p>
        <p class="mt-4 leading-5 text-gray-700">{{$component->description}}</p>

        <div class="mt-8"
            x-data="iframeComponent()"
            x-init="setHighlight()">
            <div class="flex items-center justify-between">
                <div class="flex items-center mr-8">
                    {{-- <button class="w-6 h-6 text-gray-200 ">
                        <svg class="fill-current"
                            viewBox="0 0 20 20"
                            version="1.1"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1"
                                stroke="none"
                                stroke-width="1">
                                <g id="icon-shape">
                                    <path
                                        d="M0,8.00585866 C0,6.89805351 0.897060126,6 2.00585866,6 L11.9941413,6 C13.1019465,6 14,6.89706013 14,8.00585866 L14,17.9941413 C14,19.1019465 13.1029399,20 11.9941413,20 L2.00585866,20 C0.898053512,20 0,19.1029399 0,17.9941413 L0,8.00585866 L0,8.00585866 Z M6,8 L2,8 L2,18 L12,18 L12,14 L15,14 L15,12 L18,12 L18,2 L8,2 L8,5 L6,5 L6,8 L12,8 L12,14 L17.9941413,14 C19.1029399,14 20,13.1019465 20,11.9941413 L20,2.00585866 C20,0.897060126 19.1019465,0 17.9941413,0 L8.00585866,0 C6.89706013,0 6,0.898053512 6,2.00585866 L6,8 Z"
                                        id="Combined-Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </button> --}}
                    @can('update', $component)
                    <a class="w-6 h-6 text-gray-200 rounded "
                        href="/components/{{$component->slug}}/edit">
                        <svg class="fill-current"
                            viewBox="0 0 20 20"
                            version="1.1"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1"
                                stroke="none"
                                stroke-width="1">
                                <g id="icon-shape">
                                    <path
                                        d="M12.2928932,3.70710678 L0,16 L0,20 L4,20 L16.2928932,7.70710678 L12.2928932,3.70710678 Z M13.7071068,2.29289322 L16,0 L20,4 L17.7071068,6.29289322 L13.7071068,2.29289322 Z"
                                        id="Combined-Shape"></path>
                                </g>
                            </g>
                        </svg>
                    </a>
                    @endcan
                </div>
                <div class="flex items-center justify-end">
                    <button class="px-4 py-2 mr-8 border border-blue-700 rounded hover:bg-blue-800 hover:text-white"
                        :class="mode !='#code' ? 'bg-blue-700 text-white' : ''"
                        x-on:click="
                                    setMode('#preview')">Show Peview</button>
                    <button class="px-4 py-2 border border-blue-700 rounded hover:bg-blue-800 hover:text-white"
                        :class="mode === '#code'? 'bg-blue-700 text-white' : ''"
                        x-on:click="setMode('#code')">Show Code</button>
                </div>
            </div>
            <div x-show="mode != '#code'">

                <div class="mt-4 bg-gray-700 rounded min-h-xl">
                    <div
                        class="relative max-w-full p-4 overflow-scroll bg-gray-200 border rounded resize-x resizer h-xl min-w-xs">
                        <iframe class="absolute top-0 left-0 w-full h-full rounded"
                            srcdoc="{{$component->code}}"
                            sandbox="allow-scripts allow-modals allow-same-origin">
                        </iframe>
                    </div>
                </div>
                <div class="flex justify-end mt-1 text-sm font-semibold handle">Resize the component using this handle &uarr;
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
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/atom-one-dark.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>
@endpush

@push('scripts')
<script>
    let iframe = document.querySelector('iframe')
    iframe.addEventListener('load', function () {
        let tags = iframe.contentDocument.querySelectorAll('a')
        tags.forEach(tag => {
            tag.addEventListener('click', function (e) {
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

                if (str === "#code") {
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

<script>
    let el =document.querySelector('.handle')
    function resizeHandle(e) {
        el.style.width = e[0].target.clientWidth +"px"
    } 
    
    new ResizeObserver(resizeHandle).observe(document.querySelector('.resizer'))

</script>
@endpush

@endsection