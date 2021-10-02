<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<livewire:permissions />


<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('People') }}
    </h2>
</x-slot>

<div class="p-1">
    <div x-data="toggleTabs()">
          <ul class="flex">
            <li class="pt-2 pb-1 pr-1 min-w-32" x-bind:class="{ 'bg-gray-100 min-width:': tab === 'users'}">
              <a href="javascript:;" :class="tab === 'users' ? activeClasses : inactiveClasses" x-on:click="openUsersTab" class="block px-4 py-2 font-semibold text-center rounded-t-lg">Users</a>
            </li>
            <li class="pt-2 pb-1 pr-1 min-w-32" x-bind:class="{ 'bg-gray-100 -mb-px': tab === 'roles'}">
              <a href="javascript:;" :class="tab === 'roles' ? activeClasses : inactiveClasses" x-on:click="openRolesTab" class="block px-4 py-2 font-semibold text-center rounded-t-lg">Roles</a>
            </li>
            <li class="pt-2 pb-1 pr-1 min-w-32" x-bind:class="{ 'bg-gray-100 -mb-px': tab === 'permissions'}">
              <a href="javascript:;" :class="tab === 'permissions' ? activeClasses : inactiveClasses" x-on:click="openPermissionsTab" class="block px-4 py-2 font-semibold text-center rounded-t-lg">Permissions</a>
            </li>
            <li class="pt-2 pb-1 pr-1 min-w-32" x-bind:class="{ 'bg-gray-100 -mb-px': tab === 'groups'}">
              <a href="javascript:;" :class="tab === 'groups' ? activeClasses : inactiveClasses" x-on:click="openGroupsTab" class="block px-4 py-2 font-semibold text-center rounded-t-lg">Groups</a>
            </li>
          </ul>

        @if (session()->has('message'))
            <div class="px-4 py-3 my-3 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md" role="alert">
            <div class="flex">
                <div>
                <p class="text-sm">{{ session('message') }}</p>
                </div>
            </div>
            </div>
        @endif

        <div>
            <div x-show="showTab('users')" class="p-4">
                <div><livewire:users /></div>
            </div>

            <div x-show="showTab('roles')" class="p-4">
                <div><livewire:roles /></div>
            </div>

            <div x-show="showTab('permissions')" class="p-4">
                <div class="overflow-x-auto -ml-22 sm:-mx-6 lg:-mx2">
                    <livewire:permissions />
                </div>
            </div>

            <div x-show="showTab('groups')" class="px-4 py-2">
                <div>
                    <livewire:groups />
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleTabs() {
            return {
                tab: 'users',
                activeClasses: 'border-l border-t border-r rounded-t text-white bg-blue-400 ',
                inactiveClasses: 'text-gray-500 hover:text-blue-500 bg-blue-100',
                openUsersTab() {
                    this.tab = 'users';
                },
                openRolesTab() {
                    this.tab = 'roles';
                },
                openPermissionsTab() {
                    this.tab = 'permissions';
                    this.$wire.call('refreshPermissionsComponent');
                },
                openGroupsTab() {
                    this.tab = 'groups';
                    //this.$wire.call('refreshGroupsComponent');
                },
                showTab(tab) {
                    return this.tab === tab;
                },
            };
        }

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
</div>
