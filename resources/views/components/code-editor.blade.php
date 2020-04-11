<div class="w-full">
    <div class="w-full pr-4 ml-4 ">
        <div id="editor"
            class="leading-10 rounded"
            style="height: 500px; width: 100%; line-height: 1.8"></div>
    </div>

    <textarea name="{{$field}}" id="" cols="30" rows="10" hidden></textarea>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js"
    type="text/javascript"
    charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.9/theme-tomorrow_night.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.9/mode-html.min.js"></script>
<script src="https://cloud9ide.github.io/emmet-core/emmet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.9/ext-emmet.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.9/ext-beautify.min.js"></script>
<script>
    
    var editor = ace.edit("editor");
    editor.$blockScrolling = 1
    editor.setOptions({
        "enableEmmet": true,
        "fontSize": "14px",
        "theme":"ace/theme/tomorrow_night",
        "mode":"ace/mode/html"
    });
    window.addEventListener('load', () => {
        var beautify = ace.require("ace/ext/beautify");
    beautify.beautify(editor.session)
  })
    editor.gotoLine(1)
    let html = JSON.parse(JSON.stringify(@json($component->code)))
    editor.setValue(html)
    let el = document.querySelector('[name="{{$field}}"]')
    editor.on('change', function(e) {
        el.value = editor.getValue()
    })
    
</script>
@endpush