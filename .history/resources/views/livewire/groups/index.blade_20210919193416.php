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
                <button onclick="createGroup()" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">Add Group</button><!-- wire:click="create()" -->
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
                                            <button wire:click="edit({{ $group->id }})" class="mb-2 mr-2 font-medium text-blue-600 hover:text-blue-900 focus:outline-none"><img src="/img/edit.png" title="Edit" class="w-4" /></button>
                                            <button onclick="deleteGroup({{ $group->id }})" class="mb-2 mr-2 font-medium text-red-600 hover:text-red-900 focus:outline-none"><img src="/img/delete.png" title="Delete" class="w-4"/></button>
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

let group_exist_warning_confirmed = 0;
        function createGroup() {
            //console.log("Create!");
            @this.emit('createGroup');
        }

        function update_group() {
            //console.log("Create/Update!");
            let checked_roles = [];
            let group_assigned_roles = {};
            let group_assigned_role_ids = [];
            let assigned_checked = []; //false;

            document.querySelectorAll('.rolesList').forEach(function(elem) {
                if(elem.checked) {
                    checked_roles.push(elem.value);
                }
                if(elem.getAttribute("data-belongstogroup") == 1) {
                    group_assigned_role_ids.push(elem.value);
                    group_assigned_roles[elem.value] = elem.getAttribute("data-rolename");
                }
            });

            //document.getElementById("role_list_error").innerHTML = "";
            //console.log("Checked Roles: " + checked_roles);
            //console.log("Group Assigned Roles: " + group_assigned_roles);
            //console.log("Assigned Role Ids: " + group_assigned_role_ids);

            //assigned_checked = checked_roles.some(r=> group_assigned_role_ids.indexOf(r) >= 0)
            checked_roles.forEach(function(elem, index) {
                //console.log(index + ' > ' + elem + ' > ' + group_assigned_role_ids.indexOf(elem));
                if(group_assigned_role_ids.indexOf(elem) >= 0) {
                    assigned_checked.push(group_assigned_roles[elem])
                }
            });

            //console.log("Checked Assigned Role(s): " + assigned_checked);
            //console.log("Length: " + checked_roles.length + ' > ' + Object.keys(group_assigned_roles).length + ' > ' + assigned_checked.length);

            if(checked_roles.length > 0 && Object.keys(group_assigned_roles).length > 0 && assigned_checked.length > 0) {
                //console.log("group_exist_warning_confirmed: " + group_exist_warning_confirmed);
                let confirm_msg = "The following roles are already part of other group..<br><br>" + "[ " + assigned_checked + " ]<br><br> Please select OK if you wish to proceed and Save again";

                document.getElementById('xdata_group_div').__x.$data.msg_popup_open = true;
                document.getElementById('msg_popup_content').innerHTML = confirm_msg;

                if(group_exist_warning_confirmed == 1) {
                    group_exist_warning_confirmed = 0;
                    document.getElementById('xdata_group_div').__x.$data.msg_popup_open = false;
                    @this.emit('updateGroup', checked_roles);
                }
            }
            else {
                @this.emit('updateGroup', checked_roles);
            }
        }

        function deleteGroup(id) {
            if(confirm('Are you sure?')) {
                //console.log("DELETE: " + id);
                @this.emit('deleteGroup', id);
            }
        }
</script>
