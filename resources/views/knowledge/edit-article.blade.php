<x-app-layout>
    <div x-data="page()" class="px-10">
        @if(session()->has('message'))
            <div x-data>
                @if(session()->get('message') == "Success")
                    <div id="alert" class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded-md" role="alert">
                @else
                    <div id="alert" class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded-md" role="alert">
                @endif
                    <strong class="font-bold">{{ session()->get('message') }}</strong>
                    <span x-on:click="document.getElementById('alert').remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="w-6 h-6 fill-gray-800" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            </div>
        @endif

        <div class="py-5">
            <h2 class="text-2xl font-bold">Edit Article</h2>
        </div>
        <form id="update-form" method="post" action="{{route('kb.update', $article[0]['id'])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4 mt-3 md:grid-cols-3">

                <div class="col-span-1 md:col-span-2">
                    <label for="title" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">
                        Title<span class="ml-1 text-xs text-red-500 animtate-blink">*</span>
                        @error('title')
                            <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                        @enderror
                    </label>
                    <input required type=" text" name="title" value="{{ $article[0]['article_title'] }}"
                        class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>

                <div class="relative col-span-1">
                    <div class="absolute z-30 w-64 p-5 bg-gray-100 border border-gray-200 rounded shadow-md top-5 -left-56 md" x-show="popOver">Add keywords to improve searchability<br>(seperate tags with spaces)</div>
                        <div class="-z-30">
                            <label for="tags" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">
                                Tags<span @mouseleave="popOver = false" @mouseover="popOver = true"  class="px-1 ml-1 text-xs bg-gray-300 border rounded-full hover:cursor-pointer ">?</span>
                                @error('tags')
                                    <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" name="tags" value="{{ $article[0]['tags'] }}"
                                class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        </div>
                </div>

                <div class="col-span-1">
                    <label for="section" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Section
                        <span class="ml-1 text-sm text-red-500">*</span>
                        @error('section')
                                <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                        @enderror
                    </label>
                    <select required value="{{$article[0]['id']}}" class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="section" name="section">
                        <option selected disabled>Choose</option>
                        @foreach($sections as $section)
                            <option {{ $article[0]['section_id'] == $section['id'] ? "selected" : ""}} value="{{$section['id']}}">{{$section['title']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-1">
                    <label for="scope" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Scope
                        <span class="ml-1 text-sm text-red-500">*</span>
                        @error('scope')
                            <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                        @enderror
                    </label>
                    <select required value="{{ $article[0]['scope'] }}" class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="scope" name="scope">
                        <option selected disabled>Choose</option>
                        <option {{ $article[0]['scope'] == "Public" ? "selected" : "" }}>Public</option>
                        <option {{ $article[0]['scope'] == "Private" ? "selected" : "" }}>Private</option>
                    </select>
                </div>

                <div class="col-span-1">
                    <label for="status" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Status
                        <span class="ml-1 text-sm text-red-500">*</span>
                        @error('status')
                            <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                        @enderror
                    </label>
                    <select required value="{{$article[0]['status'] }}" id="status" class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg form-control bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="scope" name="status">
                        @if($article[0]['status'] == "Published")
                            <option selected>Published</option>
                        @else
                            <option selected disabled>Choose</option>
                            <option {{$article[0]['status'] == "Publish" ? "selected" : "" }}>Publish</option>
                            <option {{ $article[0]['status'] == "Draft" ? "selected" : "" }}>Draft</option>
                        @endif
                    </select>
                </div>

                <div class="col-span-1">
                    <label for="expiry" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Expiry date
                        @error('expiry')
                            <span class="ml-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </label>
                    <input id="expire" value="{{$article[0]['expiry']}}" class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg form-control bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="expiry" type="date" />
                </div>

                <div class="col-span-1">
                    <label for="attachments" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Attachments
                        @error('upload.*')
                            <span class="ml-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </label>
                    <input id="file-upload" x-on:change="uploadChange" class="block w-full" name="upload[]" type="file" multiple />
                </div>

                <div class="col-span-1 md:col-span-1">
                    <div class="flex flex-wrap font-bold overflow-hide">Uploaded files</div>
                        @if(isset($uploads[0]))
                            @foreach($uploads as $upload)
                                <span x-data="{show: true}"x-show="show" class="mr-2">{{$upload['name']}}<span x-on:click="show = false; removeFileUpload({{$upload['id']}},'{{$upload['path']}}')" class="ml-1 text-red-500 hover:font-bold hover:text-red-600 hover:cursor-pointer">X</span></span>
                            @endforeach
                            <span class="text-sm text-red-600" x-show="loading">Deleteing ..</span>
                        @endif
                </div>
            </div>
            <div class="mt-7">
                <label for="description" class="block mb-2 font-bold text-gray-900 text-md dark:text-gray-400">Solution
                    <span class="ml-1 text-sm text-red-500">*</span>
                    @error('solution')
                        <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                    @enderror
                </label>
                <textarea required id="description" name="solution">
                    {{ $article[0]['body']}}
                </textarea>
            </div>


            <div class="py-3">
                <button type="sumbit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-400">Update</button>
            </div>
        </form>
    </div>


@include('js.base-editor')
<script>

    function page() {
        return {
            loading: false,
            popOver: false,
            attachmentCount : {{count($uploads)}},

            mouseOver(){
                alert('gg')
                popOver = ! popOver
            },


        async deleteAttachment(id,name) {
            try {
                this.loading = true
                const response = await axios.post("/delete-attachment/" + id + '/' + name);
                this.loading = false
                console.log(response.data);
            } catch (err) {
                // Handle Error Here
                this.loafding = false
                console.error(err);
            }

        },

        uploadChange()
        {
            filesToUpload = document.forms["update-form"]["upload[]"].files

            if(this.attachmentCount + filesToUpload.length > 3)
            {
                alert('No more than 3 files can be attcahed to an article')
                input = document.getElementById('file-upload');
                input.value = ''
            }
        },

        removeFileUpload(id,path){

            name = path.split('/').pop()
            console.log(name)
            this.attachmentCount --;
            this.deleteAttachment(id,name)
        },

    }

    /*
    const deleteAttachment = async (id,name) => {
            try {
                const response = await axios.post("/delete-attachment/" + id + '/' + name);
                items = response.data
                console.log(this.test)
                console.log(items);
            } catch (err) {
                // Handle Error Here
                console.error(err);
            }
        },
    */
}


</script>

</x-app-layout>
