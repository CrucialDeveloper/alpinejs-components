<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tags Component</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="h-screen w-screen">
<div class="bg-gray-500 flex items-center justify-center h-full w-full">
    <div class="bg-white rounded shadow p-4 flex flex-wrap items-center max-w-4xl" x-data="tagsComponent()">
        <div class="mr-2 flex items-center">
            <template x-for="tag in tags" :key="tag">
                <div class="bg-blue-200 text-sm px-2 py-1 rounded mr-2 mt-2 flex items-center ">
                    <div x-text="tag"></div>
                    <button class="ml-4" @click="deleteTag(tag)">x</button>
                </div>
            </template>
        </div>
        <div class="flex items-center mt-2">
            <input type="text" class="px-2 py-1 rounded-l border w-40 mr-0" x-model="newTag"
                   x-on:keydown.enter="addTag()">
            <button class="px-2 py-1 border bg-gray-300 ml-0 rounded-r" @click="newTag=''">X</button>
        </div>
    </div>
</div>
<script>
    function tagsComponent() {
        return {
            tags: ['One', 'Two'],
            newTag: '',
            addTag() {
                if (!this.tags.includes(this.newTag)) {
                    this.tags.push(this.newTag)
                    this.newTag = ""
                }
            },
            deleteTag(tag) {
                this.tags.splice(this.tags.indexOf(tag), 1)
            }
        }
    }
</script>
</body>
</html>
