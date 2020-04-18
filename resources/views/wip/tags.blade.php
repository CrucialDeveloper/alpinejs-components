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
<div class="bg-gray-500 flex items-center justify-center h-full w-full px-16">
    <div class="bg-white rounded shadow p-4 flex flex-wrap items-center max-w-4xl">
        <div class="mr-2 flex items-center">
            <div class="bg-blue-200 text-sm px-2 py-1 rounded mr-2 mt-2 flex items-center">
                <div>Tag 1</div>
                <button class="ml-4">x</button>
            </div>
        </div>
        <div class="flex items-center mt-2">
            <input type="text" class="px-2 py-1 rounded-l border w-40 mr-0">
            <button class="px-2 py-1 border bg-gray-300 ml-0 rounded-r">X</button>
        </div>
    </div>
</div>
</body>
</html>
