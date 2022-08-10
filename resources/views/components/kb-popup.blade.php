@props(['key'])
<div id="kb-{{$key}}" x-transition.duration.500ms x-trap="kbOpen" x-show="kbOpen" class="absolute w-full h-[440px] -top-[490px] ">
    <div class="p-2 text-left text-white bg-gray-800 rounded-t-xl">KB Articles</div>
    <div class="h-full py-1 border rounded-b-xl border-slate-300 bg-gray-50">
        @livewire('kb.search-kb', ['commentId' => $key], key($key))
    </div>
</div>