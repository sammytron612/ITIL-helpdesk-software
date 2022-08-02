<div class="flex justify-self-center z-99" x-data="{ showModal: true) }">
    <div  @click.outside="showModal = true" x-show="showModal">
        <div class="absolute bottom-0 left-0 right-0 flex items-center justify-center h-screen bg-opacity-50 top-50 bg-slate-800">
            <div class="px-16 text-center bg-white rounded-md py-14">
                <h1 class="mb-4 text-xl font-bold text-slate-500">Do you Want Delete</h1>
                <button class="px-4 py-2 text-white bg-red-500 rounded-md text-md">Cancle</button>
                <button class="py-2 ml-2 font-semibold text-white bg-indigo-500 rounded-md px-7 text-md">Ok</button>
            </div>
        </div>
    </div>
</div>
