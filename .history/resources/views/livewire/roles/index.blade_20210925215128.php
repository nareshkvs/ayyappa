{{-- @if(Request::is('roles'))
<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Roles
    </h2>
</x-slot>
@endif --}}
<div class="">
    <div class="max-w-6xl py-2 mx-auto sm:px-6 lg:px-8">
        <div class="">

            <div class="block mb-8 text-right">
                <button wire:click="create()" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">Add Role</button>
            </div>
            @if($isOpen)
                @include('livewire.roles.create')
            @endif
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                            <table class="w-full min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" width="50" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-blue-200">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-blue-200">
                                            Role
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-blue-200">
                                            Assigned Group(s)
                                        </th>
                                        <th scope="col" width="200" class="px-6 py-3 bg-blue-200">

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($roles as $role)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $sequence++ }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $role->role_name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ isset($role->group_name)?$role->group_name:'' }}</td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                            <button wire:click="edit({{ $role->id }})" class="mb-2 mr-2 font-medium text-blue-600 hover:text-blue-900 focus:outline-none"><img src="/img/edit.png" title="Edit" class="w-4" /></button>
                                            <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete({{ $role->id }})" class="mb-2 mr-2 font-medium text-red-600 hover:text-red-900 focus:outline-none"><img src="/img/delete.png" title="Delete" class="w-4"/></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    @this.on('showStatusMsg', (msg, color) => {
        show_banner(msg, color);
    });
});
</script>
