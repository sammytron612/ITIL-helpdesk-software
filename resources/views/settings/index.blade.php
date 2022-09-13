<x-new-layout>
    <div class="flex flex-wrap justify-center gap-x-4 gap-y-4 px-2">
        <a class="mb-3 h-64 w-56 border rounded-b-md rounded-t-md bg-yellow-500  shadow-md" href="{{ route('incidentFields')}}">
            <div class="text-center px-2 py-2 border-b border-gray-500 bg-gray-900 text-white">
                Incident Fields
            </div>
            <div class="p-2  text-gray-900">
                Manage fields that are included on a new incident
                And if those fields or mandatory.
            </div>
        </a>

        <a class="mb-3 h-64 w-56 border rounded-b-md rounded-t-md bg-yellow-500  shadow-md" href="{{ route('ticketWorkflow')}}">
            <div class="text-center px-2 py-2 border-b border-gray-500 bg-gray-900 text-white">
                Ticket Workflow
            </div>
            <div class="p-2  text-gray-900 ">
                Manage how tickets are allocated
            </div>
        </a>

        <a class="mb-3 h-64 w-56 border rounded-b-md rounded-t-md bg-yellow-500  shadow-md" href="{{ route('incidentFields')}}">
            <div class="text-center p2-5 py-2 border-b border-gray-500 bg-gray-900 text-white">
                SLA
            </div>
            <div class="p-2  text-gray-900">
                Manage service level agreements
            </div>
        </a>

        <a class="mb-3 h-64 w-56 border rounded-b-md rounded-t-md bg-yellow-500  shadow-md" href="{{ route('incidentFields')}}">
            <div class="text-center py-2 border-b border-gray-500 bg-gray-900 text-white">
                User & Group Management
            </div>
            <div class="p-2 text-gray-900">
                Manage users, agents and groups
            </div>
        </a>
    </div>
</x-new-layout>
