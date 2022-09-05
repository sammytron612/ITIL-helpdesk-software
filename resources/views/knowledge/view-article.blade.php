<x-new-layout>
    <div class="px-16 pb-5 h-100">
        <div class="float-right"><span class="hover:cursor-pointer"><x-svg.share /></span></div>
        <div class="grid items-center grid-cols-1 border-b border-gray-300 lg:grid-cols-3">
            <div class="col-span-1 py-5 text-4xl font-semibold border-b border-gray-300 md:col-span-3">
                {{$article['title']}}
            </div>
            <div class="col-span-1 p-2 py-4 text-lg">
                <span class="font-semibold">Section</span> - <span class="font-bold text-blue-600"><a href="">{{$article['section']}}</a><span>
            </div>
            <div class="flex items-center col-span-1 p-2 py-4 text-lg font-semibold">
                <span class="mr-2">Author</span><x-avatar :colour="$creator->my_avatar->colour" :name="$creator->name">
                                {{$creator->name}}
                            </x-avatar>
            </div>
            <div class="flex items-center col-span-1 p-2 py-4 text-lg">
                <span class="ml-1 font-semibold">Views - </span>{{$article['views']}}
            </div>
            <div class="col-span-1 p-2 py-4 text-lg font-semibold">
                KB{{$article['kb']}}
            </div>
            <div class="col-span-1 p-2 pt-4 pb-6 text-lg">
                <span class="font-semibold">Created</span> - {{ \Carbon\Carbon::parse($article['created'])->diffForHumans()}}
            </div>
            <div class="col-span-1 p-2 pt-4 pb-6 text-lg font-semibold md:col-span-1">
                Uploaded files
            </div>
            <div class="col-span-1"></div><div class="col-span-1"></div>
            <div class="col-span-1 pb-5">
                @if(isset($uploads[0]))
                    @foreach($uploads as $upload)
                        @php
                            $last = explode('/',$upload['path']);
                            $last = end($last);
                        @endphp
                        <div><a href="{{url('file-download/' . $last .'/' . $upload['name'])}}" class="inline-block ml-2">{{$upload['name']}}<x-svg.download /></a></div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="w-full p-5 border border-gray-400 shadow-xl mt-7">
            <div class="prose max-w-none">
                <div>{!! $article['body'] !!}</div>
            </div>

        </div>
    </div>

</x-new-layout>
