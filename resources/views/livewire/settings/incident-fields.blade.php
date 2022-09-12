<div>
    <div wire:ignore  class="grid grid-cols-12 justify-center px-2 lg:px-20 gap-x-5">

        <div id="remove" class="col-span-5 text-1xl text-center drop-targets font-bold border border-gray-500 w-auto h-auto">
            <div class="text-center py-5 text-2xl border-b border-gray-500 bg-green-700 text-white">Fields</div>
            @foreach($fields as $field)
                @if($field['active'] === false)
                    <div draggable="true" class="hover:cursor-grab border border-gray-500 p-3 draggable">{{ucwords($field['field'])}}<input wire:click="toggleCheck('{{$field['field']}}')" class="float-right" type="checkbox" {{ $field['mandatory'] ? 'checked' : '' }} /></div>
                @endif
            @endforeach
        </div>

        <div class="col-span-1 h-auto flex justify-center items-center">
            < >
        </div>

        <div id="add" class="col-span-5 text-1xl text center drop-targets font-bold border border-gray-500 w-auto h-auto">
            <div class="text-center py-5 text-2xl bg-blue-700 text-white">Current fields</div>
            <div class="border border-gray-500 p-3 opacity-70">Title<input class="float-right" type="checkbox" checked disabled /></div>
            <div class="border border-gray-500 p-3 opacity-70">Priority<input class="float-right" type="checkbox" checked disabled /></div>
            <div class="border border-gray-500 p-3 opacity-70">Category<input class="float-right" type="checkbox" checked disabled /></div>
            @foreach($fields as $field)
                @if($field['active'] === true)
                    <div draggable="true" class="hover:cursor-grab border border-gray-500 p-3 draggable">{{ucwords($field['field'])}}<input wire:click="toggleCheck('{{$field['field']}}')" class="float-right" type="checkbox" {{ $field['mandatory'] ? 'checked' : '' }} /></div>
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

        if(el.id == 'remove') {
            @this.call('removeField',text)}
        else{

            @this.call('addField',text)
        }

    }

    </script>
</div>
