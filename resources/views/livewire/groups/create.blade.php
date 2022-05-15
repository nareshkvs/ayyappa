<div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div id="xdata_group_div" class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline" x-data="{ msg_popup_open: false }">
            <form id="create_update_group">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="group_name" class="block mb-2 text-sm font-bold text-gray-700">Name:</label>
                            <input type="text" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="group_name" placeholder="Enter Group" wire:model="name" onkeydown="return event.key != 'Enter';">
                            @error('name')
                                <span id="group_name_error" class="text-red-500"> {{ $message }} </span>
                            @enderror
                            {{-- @if($group_id == '')
                                @error('name')
                                <span id="group_name_error" class="text-red-500"> {{ $message }} </span>
                                @enderror
                            @else 
                            <span id="group_name_error" class="text-red-500"></span>
                            @endif --}}
                        </div>
                        <div class="mb-4 overflow-y-auto h-96">
                            <label class="block mb-2 text-sm font-bold text-gray-700">Roles:</label>
                            {{-- $group_id --}}
                            {{-- print_r($groupRolesList); --}}
                            {{-- print_r($assignedRoles); --}}

                            <?php if(count($roles) > 0) { ?>
                            @foreach($roles as $role)
                                <div>
                                    <label>
                                        @if($group_id != '')
                                        <input type="checkbox" name="rolesList[]" class="rolesList ml-1"  value="{{ $role->id }}" data-rolename="{{ $role->name }}" 
                                        @if(in_array($role->id, $groupRolesList)) checked="checked" @endif @if(in_array($role->id, $assignedRoles)) data-belongstogroup="1" @endif />
                                        @else
                                        <input type="checkbox" wire:model="rolesList" name="rolesList[]" class="rolesList ml-1" value="{{ $role->id }}" data-rolename="{{ $role->name }}" @if(in_array($role->id, $assignedRoles)) data-belongstogroup="1" @endif />
                                        @endif
                                        {{ $role->name }}
                                </label>
                                </div>
                            @endforeach

                            @error('rolesList')
                                <span id="role_list_error" class="text-red-500"> {{ $message }} </span>
                            @enderror
                            {{-- @if($group_id == '')
                                @error('rolesList')
                                <span id="role_list_error" class="text-red-500"> {{ $message }} </span>
                                @enderror
                            @else 
                            <span id="role_list_error" class="text-red-500"></span>
                            @endif --}}
                            <?php } else { ?>
                                <div class="text-red-500">
                                    <label>Roles are not available. Please add roles</label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div id="sub_popup" class="w-full absolute top-0 left-0 flex items-center justify-center"
                style="background-color: rgba(0,0,0,.5); height:100%" x-show="msg_popup_open">
                    <div id="sub_popup_content"
                        class="w-11/12 h-11/12 p-4 mx-2 text-left bg-white rounded shadow-xl md:p-4 lg:p-6 md:mx-0"
                        style="height:auto" @click.away="msg_popup_open = false">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <div class="mt-2">
                                <p id="msg_popup_content" class="font-medium leading-5 text-gray-500">
                                </p>
                            </div>
                        </div>

                        <div class="mr-28 w-1/5 ml-4 mt-14 float-right">
                            <span class="flex rounded-md shadow-sm">
                                <button id="cancel_confirm"
                                    @click="group_exist_warning_confirmed = 0; msg_popup_open = false; document.getElementById('msg_popup_content').innerHTML = ''; return false;"
                                    class="inline-flex justify-center w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                                    Cancel
                                </button>
                            </span>
                        </div>
                        <div class="w-1/5 mt-14 float-right">
                            <span class="flex rounded-md shadow-sm">
                                <button id="ok_confirm"
                                    @click="group_exist_warning_confirmed = 1; msg_popup_open = false; document.getElementById('msg_popup_content').innerHTML = ''; return false;"
                                    class="inline-flex justify-center w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                                    OK
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <?php if(count($roles) > 0) { ?>
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button onclick="update_group()" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5"><!-- wire:click.prevent="store()" -->
                        Save
                        </button>
                    </span>
                    <?php } ?>
                    <span class="flex w-full mt-3 rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue sm:text-sm sm:leading-5">
                            Cancel
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
