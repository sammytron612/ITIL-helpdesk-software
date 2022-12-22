<x-new-layout>

    @if(session('status'))
        @php
            session()->forget('status');
        @endphp
        <div class="px-5">
            <div id="alert" x-data class="relative px-4 py-3 bg-green-100 border rounded border-greenb-400 text-slate-gray-400" role="alert">
                <strong class="font-bold">SUCCESS - Incident Created</strong>
                <span x-on:click="document.getElementById('alert').remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="w-6 h-6 fill-current text-slate-gray-800" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </div>
    @endif

    <div class="px-10">
        <div class="py-5">
            <h2 class="text-2xl font-bold">New incident</h2>
        </div>
        <form method="post" action="{{route('ticket.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-4 mt-3 md:gap-6 md:grid-cols-3">

                <div class="md:col-span-3">
                    <div class="lg:w-2/3">
                        <label for="title" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">
                            Brief description of problem<span class="ml-1 text-xs text-red-500">*</span>
                            @error('title')
                                <span class="ml-1 text-xs text-red-600 animate">{{ $message }}</span>
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
                            <span class="ml-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </label>

                    <select id="priority" name="priority" required value="old('priority)"
                        class="bg-gray-50 mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Choose </option>
                        @foreach($priorities as $priority)
                            <option @if(old('priority') == $priority->id) selected @endif value="{{ $priority->id }}">{{ $priority->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    @livewire('tickets.category-dropdown', ['old' => old('category')])
                </div>

                @if($subCategory)
                    <div>
                        @livewire('tickets.subcategory-dropdown', ['old_sub' => old('sub_category'), 'category' => old('category'), 'mandatory' => $subMandatory])
                    </div>
                @endif

                @if($departments)
                    <div>
                        <label for="department" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Select a department
                            @if($deptMandatory) <span class="ml-1 text-sm text-red-500">*</span> @endif
                            @error('department')
                                <span class="ml-1 text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </label>

                        <select id="department" name="department" value="{{old('department')}}" @if($deptMandatory) required @endif
                            class="bg-gray-50 mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Choose </option>
                            @foreach($departments as $department)
                                <option @if(old('department') == $department->id) selected @endif value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if($sites)
                    <div>
                        <label for="site" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Select a location
                            @if($locMandatory) <span class="ml-1 text-sm text-red-500">*</span> @endif
                            @error('site')
                                <span class="ml-1 text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </label>

                        <select id="site" name="site" value="old('site')"
                            class="bg-gray-50 mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">Choose </option>
                            @foreach($sites as $site)
                                <option @if(old('site') == $site->id) selected @endif value="{{ $site->id }}">{{ $site->name }}</option>
                                @endforeach
                        </select>
                    </div>
                @endif

                <div>
                    <label for="attachments" class="mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Attachments
                        @error('attachments')
                            <span class="ml-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </label>
                    <input id="attachments" type="file" class="form-control
                    block
                    w-full
                    mt-2
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="attachments[]" multiple>
                </div>

                <div class="md:col-span-3">
                    <label for="description" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-400">Description
                        <span class="ml-1 text-sm text-red-500">*</span>
                        @error('comment')
                            <span class="ml-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </label>
                    <textarea id="description" name="comment" class="w-full h-48" >{{ old('comment') }}</textarea>
                </div>

            </div>
            <div class="py-3">
                <button type="sumbit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-400">Submit</button>
            </div>
        </form>
    </div>


@include('js.base-editor')


</x-new-layout>
