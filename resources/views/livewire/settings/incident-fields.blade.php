<div>
    <div wire:ignore  class="grid justify-center grid-cols-12 px-2 lg:px-20 gap-x-5">

        <div id="remove" class="w-auto h-auto col-span-5 p-2 font-bold text-center border border-gray-500 text-1xl drop-targets">
            <div class="py-2 text-center text-white bg-gray-900 border-b border-gray-500 text-1xl">Available fields</div>
            @foreach($fields as $field)

                @if($field['active'] == false)

                    <div draggable="true" class="p-3 my-1 bg-gray-200 border border-gray-500 shadow-lg hover:cursor-grab draggable">{{ucwords($field['field'])}}<input wire:click="toggleCheck('{{$field['field']}}')" class="float-right" type="checkbox" {{ $field['mandatory'] ? 'checked' : '' }} @if($field['field'] == "subcategory") disabled @endif/></div>
                @endif
            @endforeach
        </div>

        <div class="flex items-center justify-center h-auto col-span-1">
            < >
        </div>

        <div id="add" class="w-auto h-auto col-span-5 p-2 font-bold border border-gray-500 text-1xl text center drop-targets">
            <div class="py-2 text-center text-white bg-gray-900 text-1xl">Current fields</div>
            <div class="p-3 my-1 border border-gray-500 shadow-lg opacity-70">Title<input class="float-right" type="checkbox" checked disabled /></div>
            <div class="p-3 my-1 border border-gray-500 shadow-lg opacity-70">Priority<input class="float-right" type="checkbox" checked disabled /></div>
            <div class="p-3 my-1 border border-gray-500 shadow-lg opacity-70">Category<input class="float-right" type="checkbox" checked disabled /></div>
            @foreach($fields as $field)
                @if($field['active'] === true)
                    @if($field['field'] == 'location' && $locActive)
                        <div class="p-3 my-1 bg-gray-200 border border-gray-500 shadow-lg opacity-70">{{ucwords($field['field'])}}<input disabled wire:click="toggleCheck('{{$field['field']}}')" class="float-right" type="checkbox" {{ $field['mandatory'] ? 'checked' : '' }} /></div>
                    @else
                        <div draggable="true" class="p-3 my-1 bg-gray-200 border border-gray-500 shadow-lg hover:cursor-grab draggable">{{ucwords($field['field'])}}<input wire:click="toggleCheck('{{$field['field']}}')" class="float-right" type="checkbox" {{ $field['mandatory'] ? 'checked' : '' }} @if($field['field'] == "subcategory") disabled @endif/></div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
    <script>

    const items = document.querySelectorAll('.draggable');

        items.forEach(item =>{

            item.addEventListener('dragstart', dragStart);

        })



    function dragStart(e) {

        e.dataTransfer.setData('text/plain', e.target.id);
        e.target.style.cursor = "grabbing"
        e.target.classList.add('dragging');
        e.target.classList.remove('bg-gray-200');
        e.target.classList.add('bg-green-400');

        setTimeout(() => {
            //e.target.classList.add('hide');
        }, 0);
    }


    /* drop targets */
    const targets = document.querySelectorAll('.drop-targets');

    targets.forEach(target => {
        target.addEventListener('dragenter', dragEnter)
        target.addEventListener('dragover', dragOver);
        target.addEventListener('dragleave', dragLeave);
        target.addEventListener('drop', drop);
    });

    function dragEnter(e) {

        e.preventDefault();
        e.target.style.cursor = "grabbing"
        e.target.classList.add('dragging');

    }


    function dragEnter(e) {
        e.preventDefault();


    }

    function dragOver(e) {
        e.preventDefault();
        e.target.classList.add('drag-over');
    }

    function dragLeave(e) {
        e.target.classList.remove('drag-over');
        e.target.classList.remove('bg-green-400');
    }

    function drop(e) {
        e.target.classList.remove('drag-over');

        el = e.target
        // get the draggable element
        //const id = e.dataTransfer.getData('text/plain');
        var dragged = document.getElementsByClassName('dragging')[0]

        if(!el.classList.contains('drop-targets'))
        {
            el = el.parentNode
        }

        el.appendChild(dragged)
        var text = (dragged.innerText).toLowerCase()

        dragged.classList.remove('dragging')
        dragged.classList.add('cursor-grab')
        dragged.classList.remove('bg-green-400');
        dragged.classList.add('bg-gray-200');

        if(el.id == 'remove') {
            @this.call('removeField',text)}
        else{

            @this.call('addField',text)
        }

    }

    </script>
</div>
