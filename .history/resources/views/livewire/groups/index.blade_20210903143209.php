@if(Request::is('groups'))
<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Groups
    </h2>
</x-slot>
@endif
<div class="">
    <div class="max-w-6xl py-2 mx-auto sm:px-6 lg:px-8">
        <div class="">

            <div class="block mb-8 text-right">
            @if (strtolower($userRole) == 'admin')
                <button onclick="createGroup()" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">Add Group</button><!-- wire:click="create()" -->
            @endif
            </div>
            @if($isOpen)
                @include('livewire.groups.create')
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
                                            Group
                                        </th>
                                        <th scope="col" width="200" class="px-6 py-3 bg-blue-200">

                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if($groups && count($groups) > 0)
                                    @foreach($groups as $group)
                                    <tr wire:key="item-{{$group->id}}">
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $sequence++ }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $group->name }}</td>
                                        
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                        @if (strtolower($userRole) == 'admin')
                                            <button wire:click="edit({{ $group->id }})" class="mb-2 mr-2 font-medium text-blue-600 hover:text-blue-900 focus:outline-none"><img src="/img/edit.png" title="Edit" class="w-4" /></button>
                                            <button onclick="deleteGroup({{ $group->id }})" class="mb-2 mr-2 font-medium text-red-600 hover:text-red-900 focus:outline-none"><img src="/img/delete.png" title="Delete" class="w-4"/></button><!-- onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete({{ $group->id }})" -->
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
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