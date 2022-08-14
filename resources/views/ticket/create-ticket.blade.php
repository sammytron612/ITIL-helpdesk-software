<x-new-layout>

    @if(session()->has('message'))
        <div id="alert" x-data class="relative px-4 py-3 bg-green-100 border rounded border-greenb-400 text-slate-gray-400" role="alert">
            <strong class="font-bold">{{ session()->get('message') }}</strong>
            <span x-on:click="document.getElementById('alert').remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="w-6 h-6 fill-current text-slate-gray-800" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif
    <div class="py-5">
        <h2 class="text-2xl font-bold">New incident</h2>
    </div>
    <form method="post" action="{{route('ticket.store')}}">
        @csrf
        <div class="grid grid-cols-1 gap-4 mt-3 md:gap-6 md:grid-cols-3">

            <div class="md:col-span-3">
                <div class="lg:w-2/3">
                    <label for="title" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">
                        Title<span class="ml-1 text-xs text-red-500 animtate-blink">*</span>
                        @error('title')
                            <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                        @enderror
                    </label>
                    <input type=" text" name="title" value="{{ old('title') }}" required
                        class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>
            </div>

            <div>
                <label for="priority" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Select a priority
                    <span class="ml-1 text-sm text-red-500">*</span>
                    @error('priority')
                        <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                    @enderror
                </label>

                <select id="priority" name="priority" required
                    class="bg-gray-50 mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Choose </option>
                    @foreach($priorities as $priority)
                        <option value="{{ $priority->id }}">{{ $priority->priority }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                @livewire('tickets.category-dropdown')
            </div>

            <div>
                @livewire('tickets.subcategory-dropdown')
            </div>

            <div>
                <label for="department" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Select a department
                    <span class="ml-1 text-sm text-red-500">*</span>
                    @error('Department')
                        <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                    @enderror
                </label>

                <select id="department" name="department"
                    class="bg-gray-50 mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Choose </option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->title }}</option>
                        @endforeach
                </select>
            </div>

            <div>
                <label for="site" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Select a site
                    <span class="ml-1 text-sm text-red-500">*</span>
                    @error('site')
                        <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                    @enderror
                </label>

                <select id="site" name="site"
                    class="bg-gray-50 mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Choose </option>
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->name }}</option>
                        @endforeach
                </select>
            </div>

            <div class="md:col-span-3">
                <label for="description" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Description
                    <span class="ml-1 text-sm text-red-500">*</span>
                    @error('description')
                        <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                    @enderror
                </label>
                <textarea id="description" name="comment" class="w-full h-48" ></textarea>
            </div>

        </div>
        <div class="py-3">
            <button type="sumbit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-400">Submit</button>
        </div>
    </form>

    
@include('js.base-editor')



    
<!--
    <script src="https://cdn.tiny.cloud/1/d3utf658spf5n1oft4rjl6x85g568jj7ourhvo2uhs578jt9/tinymce/5/tinymce.min.js"
        referrerpolicy="origin">
    </script>

    <script>

        tinymce.init({

        
        relative_urls : false,
        selector: '#description',
        forced_root_block : 'p',
        forced_root_block_attrs: { "class": "py-3"},
        plugins: 'autoresize, fullscreen hr image autolink lists  media table paste textpattern help',
        menubar: 'insert fullscreen hr image ',
        toolbar: 'fullscreen  image casechange code pageembed permanentpen table advancedlist paste pastetext spellchecker formatselect hr| bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '{{ route("image.upload") }}');
        var token = '{{ csrf_token() }}';
        xhr.setRequestHeader("X-CSRF-Token", token);
        xhr.onload = function() {
        var json;
        if (xhr.status != 200) {
        failure('HTTP Error: ' + xhr.status);
        return;
        }
        json = JSON.parse(xhr.responseText);

        if (!json || typeof json.location != 'string') {
        failure('Invalid JSON: ' + xhr.responseText);
        return;
        }
        success(json.location);
        };
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        xhr.send(formData);
        }


        });

    </script>
-->
</x-new-layout>
