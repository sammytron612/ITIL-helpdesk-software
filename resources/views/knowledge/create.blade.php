<x-app-layout>

    <div class="px-10">
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
            <h2 class="text-2xl font-bold">New Article</h2>
        </div>
        <form method="post" action="{{route('kb.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-4 mt-3 md:gap-6 md:grid-cols-3">

                <div class="col-span-2">
                    <div class="">
                        <label for="title" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">
                            Title<span class="ml-1 text-xs text-red-500 animtate-blink">*</span>
                            @error('title')
                                <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                            @enderror
                        </label>
                        <input required type=" text" name="title" value="{{ old('title') }}"
                            class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                    </div>
                </div>

                <div class="col-span-1">
                    <div class="-z-30">
                        <label for="tags" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">
                            Tags<span @mouseleave="popOver = false" @mouseover="popOver = true"  class="px-1 ml-1 text-xs bg-gray-300 border rounded-full hover:cursor-pointer ">?</span>
                            @error('tags')
                                <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                            @enderror
                        </label>
                        <input type="text" name="tags" value="{{ old('tags') }}"
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
                    <select required value="{{ old('section') }}" class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="section" name="section">
                        <option selected disabled>Choose</option>

                        @foreach($sections as $section)
                            <option {{ old('section') == $section['id'] ? "selected" : ""}} value="{{$section['id']}}">{{$section['title']}}</option>
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
                    <select required value="{{ old('scope') }}" class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="scope" name="scope">
                        <option selected disabled>Choose</option>
                        <option {{ old('status') == "Public" ? "selected" : "" }}>Public</option>
                        <option {{ old('status') == "Publish" ? "selected" : "" }}>Private</option>
                    </select>
                </div>

                <div class="col-span-1">
                    <label for="status" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Status
                        <span class="ml-1 text-sm text-red-500">*</span>
                        @error('status')
                            <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                        @enderror
                    </label>
                    <select required value="{{ old('status') }}" id="status" class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg form-control bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="scope" name="status">
                        <option selected disabled>Choose</option>
                        <option {{ old('status') == "Publish" ? "selected" : "" }}>Publish</option>
                        <option {{ old('status') == "Draft" ? "selected" : "" }}>Draft</option>
                    </select>
                </div>

                <div class="col-span-1">
                    <label for="attachments" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Attachments
                        @error('upload.*')
                            <span class="ml-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </label>
                    <input class="block w-full" name="upload[]" type="file" multiple />
                </div>

                <div class="col-span-1">
                    <label for="expiry" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Expiry date
                        @error('expiry')
                            <span class="ml-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </label>
                    <input id="expiry" class="block w-full p-2 mt-2 text-sm text-gray-900 border border-gray-300 rounded-lg form-control bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="expiry" type="date" />
                </div>

                <div class="col-span-3">
                    <label for="description" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Solution
                        <span class="ml-1 text-sm text-red-500">*</span>
                        @error('solution')
                            <span class="ml-1 text-xs text-red-600 animate-ping">{{ $message }}</span>
                        @enderror
                    </label>
                    <textarea required id="description" name="solution" class="prose max-w-none" >
                        {{ old('solution')}}
                    </textarea>
                </div>

            </div>
            <div class="py-3">
                <button type="sumbit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-400">Submit</button>
            </div>
        </form>
    </div>


@include('js.base-editor')


</x-app-layout>
