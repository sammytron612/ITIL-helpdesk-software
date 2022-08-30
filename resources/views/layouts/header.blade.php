<div class="relative">
    <div :class="openNav ? 'ml-0 md:ml-40 w-[calc(100vw_-_5rem)] md:w-[calc(100vw_-_15rem)]' : 'ml-0 md:ml-0 w-[calc(100vw_-_1rem)] md:w-[calc(100vw_-_5rem)]'" class="fixed z-20 top-[60px]">
        @livewire('view-ticket.header', ['ticket' => $ticket])
    </div>
</div>
