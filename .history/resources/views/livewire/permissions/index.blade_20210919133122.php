<div class="">
    <div class="max-w-6xl px-4 py-0 mx-auto ">

        <div
            x-data="{
            openTab: 1,
            activeClasses: 'border-l border-t border-r rounded-t text-white bg-gray-400 ',
            inactiveClasses: 'text-gray-500 hover:text-blue-500 bg-white ',
            showManageUserPermissions() {
                this.openTab = 1;
                this.$wire.emit('refreshPermissionComponent');
            },
            showPermissions() {
                this.openTab = 2;
            }
            }"
        >
            <ul class="flex border-b">
                <li @click="showManageUserPermissions()" :class="{ '-mb-px': openTab === 1 }" class="-mb-px">
                    <a :class="openTab === 1 ? activeClasses : inactiveClasses" class="inline-block px-4 py-2 font-semibold text-center rounded-t-lg" href="javascript:;">
                    Manage User Permissions
                    </a>
                </li>
                <li @click="showPermissions()" :class="{ '-mb-px': openTab === 2 }" class="">
                    <a :class="openTab === 2 ? activeClasses : inactiveClasses" class="inline-block px-4 py-2 font-semibold text-center rounded-t-lg" href="javascript:;">Configure Permissions</a>
                </li>
            </ul>
            <div class="w-full pt-1">
                <div x-show="openTab === 1">
                    <div class="border border-blue-300 permissions-screen-height">
                        <div class="text-sm table-container permissions-screen-child-height">
                            <table class="w-screen text-sm table-fixed main-table" style="">
                                <thead class="">
                                    <tr id="table-sticky-header ">
                                        <th class="left-0 bg-gray-100 border z-100 w-96 fixed-row border-emerald-500" style="z-index: 100; width: 35%;">Permissions</th>
                                        @foreach ($roles as $role)
                                            <th class=" px-2 py-2 w-96 border fixed-row z-10 @if ($role->type == 'Internal')
                                                bg-green-400
                                            @else
                                                bg-blue-300
                                            @endif" title="{{ $role->type }}" style="width: 20%;"> {{ $role->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($permissions as $pIndex=>$permission)
                                        <tr class="justify-center hover:bg-orange-100">
                                            <td class="z-10 w-auto px-2 py-1 border fixed-side-first-column border-emerald-500"  @if($pIndex%2!=0) style="background: #f0f8ff;" @endif>{{ $permission->name }}</td>
                                            @foreach ($roles as $rIndex => $role)
                                                <td class="px-2 py-1 border w-96 fixed-side border-emerald-500 " style="width: 20%;">
                                                    <div class="text-center">
                                                        <label class="inline-flex items-center">
                                                          <input type="checkbox" wire:model="role_has_permissions.{{$role->id}}.{{$permission->id}}" class="text-green-500 form-checkbox" value="{{$permission->name}}">
                                                          {{-- <span class="ml-2">{{ $role->name }}</span> --}}
                                                        </label>
                                                      </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div x-show="openTab === 2">
                    <livewire:permissionslist />
                </div>
                <div x-show="openTab === 3">
                    <div class="border border-blue-300 permissions-screen-height">
                        <div class="text-sm table-container permissions-screen-child-height">
                            <table class="w-screen text-sm table-fixed main-table" style="">
                                <thead class="">
                                    <tr id="table-sticky-header ">
                                        <th class="left-0 bg-gray-100 border z-100 w-96 fixed-row border-emerald-500" style="z-index: 100; width: 35%;">Permissions</th>
                                        @foreach ($roles as $role)
                                            <th class=" px-2 py-2 w-96 border fixed-row z-10 @if ($role->type == 'Internal')
                                                bg-green-400
                                            @else
                                                bg-blue-300
                                            @endif" title="{{ $role->type }}" style="width: 20%;"> {{ $role->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($fieldPermissions as $pIndex=>$permission)
                                        <tr class="justify-center hover:bg-orange-100">
                                            <td class="z-10 w-auto px-2 py-1 border fixed-side-first-column border-emerald-500"  @if($pIndex%2!=0) style="background: #f0f8ff;" @endif>{{ $permission->name }}</td>
                                            @foreach ($roles as $rIndex => $role)
                                                <td class="px-2 py-1 border w-96 fixed-side border-emerald-500 " style="width: 20%;">
                                                    <div class="text-center">
                                                        <label class="inline-flex items-center">
                                                          <input type="checkbox" wire:model="role_has_permissions.{{$role->id}}.{{$permission->id}}" class="text-green-500 form-checkbox" value="{{$permission->name}}">
                                                          {{-- <span class="ml-2">{{ $role->name }}</span> --}}
                                                        </label>
                                                      </div>
                                                </td>
                                            @endforeach
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
