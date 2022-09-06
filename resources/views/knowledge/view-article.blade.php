<x-app-layout>
    <div class="px-16 pb-5 h-100">
        @if($article[0]['scope'] == 'Public') <div class="float-right"><span class="hover:cursor-pointer"><x-svg.share /></span></div> @endif
        <div class="grid items-center grid-cols-1 border-b border-gray-300 lg:grid-cols-3">
            <div class="col-span-1 py-5 text-4xl font-semibold text-blue-700 border-b border-gray-300 md:col-span-3">
                {{$article[0]['article_title']}}
            </div>
            <div class="col-span-1 py-4 text-lg">
                <span class="font-semibold"><i class="mr-1 fa-regular fa-book-section"></i>Section</span> - <span class="font-bold text-blue-600"><a href="">{{$article[0]['section_title']}}</a><span>
            </div>
            <div class="flex items-center col-span-1 py-4 text-lg font-semibold">
                <span><i class="mr-1 fa-solid fa-user"></i>Author - <span class="font-bold text-blue-600">{{$article[0]['author_name']}}</span></span>
            </div>
            <div class="flex items-center col-span-1 py-4 text-lg">
                <span class="font-semibold"><i class="mr-1 fa-solid fa-eye"></i>Views -&nbsp</span>{{$article[0]['views']}}
            </div>
            <div class="col-span-1 py-4 text-lg font-semibold">
                <span><i class="mr-1 fa-solid fa-book-open"></i>KB{{$article[0]['kb']}}</span>
            </div>
            <div class="col-span-1 pt-4 pb-6 text-lg">
                <span class="font-semibold"><i class="mr-1 fa-solid fa-calendar"></i>Created</span> - {{ \Carbon\Carbon::parse($article[0]['created_at'])->diffForHumans()}}
            </div>
            <div class="col-span-1 pt-4 pb-6 text-lg">
                <span class="font-semibold"><i class="fa-solid fa-key-skeleton-left-right"></i>Scope</span> - {{$article[0]['scope']}}
            </div>
            <div class="col-span-1 pt-4 pb-6 text-lg font-semibold md:col-span-1">
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
                        <div><a href="{{url('file-download/' . $last .'/' . $upload['name'])}}" class="inline-block mr-2">{{$upload['name']}}<x-svg.download /></a></div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="w-full p-5 border border-gray-400 shadow-xl mt-7">
            <div class="prose max-w-none">
                <div>{!! $article[0]['body'] !!}</div>
            </div>

        </div>
    </div>

</x-app-layout>
