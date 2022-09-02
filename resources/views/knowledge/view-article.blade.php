<x-new-layout>
    <div class="px-16 py-5 mt-5">
        <div class="grid items-center grid-cols-1 border-b border-gray-400 md:grid-cols-3">
            <div class="col-span-1 p-2 text-4xl font-semibold md:col-span-3">
                {{$article['title']}}
            </div>
            <div class="col-span-1 p-2 py-4 text-lg">
                <span class="font-semibold">Section</span> - {{$article['section']}}
            </div>
            <div class="flex items-center col-span-1 p-2 py-4 text-lg font-semibold">
                <span class="mr-2">Author</span><x-avatar :colour="$creator->my_avatar->colour" :name="$creator->name">
                                {{$creator->name}}
                            </x-avatar>
            </div>
            <div class="col-span-1 p-2 py-4 text-lg">
                <span class="font-semibold">Views</span> - {{$article['views']}}
            </div>
            <div class="col-span-1 p-2 py-4 text-lg font-semibold">
                KB{{$article['kb']}}
            </div>
            <div class="col-span-1 p-2 pt-4 pb-6 text-lg">
                <span class="font-semibold">Created</span> - {{ \Carbon\Carbon::parse($article['created'])->diffForHumans()}}
            </div>
        </div>

        <div class="p-6 mt-8 border border-gray-300 shadow-xl md:p-12 min-h-fit">
            {!! $article['body'] !!}
        </div>
    </div>
</x-new-layout>
