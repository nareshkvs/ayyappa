<div>
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
              <div>Users{{-- <livewire:users /> --}}</div>
          </div>

          <div x-show="showTab('roles')" class="p-4">
              <div>Roles</div>
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
                  //this.$wire.call('refreshPermissionsComponent');
              },
              openGroupsTab() {
                  this.tab = 'groups';
              },
              showTab(tab) {
                  return this.tab === tab;
              },
          };
      }



  </script>
</div>
