<div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="">
                        <!-- First Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="first_name" value="{{ __('First Name') }}" />
                            <x-jet-input id="first_name" type="text" class="block w-full mt-1" wire:model.defer="first_name" autocomplete="firstname" />
                            <x-jet-input-error for="first_name" class="mt-2 text-red-500" />
                        </div>

                        <!-- last Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="last_name" value="{{ __('Last Name') }}" />
                            <x-jet-input id="last_name" type="text" class="block w-full mt-1" wire:model.defer="last_name" autocomplete="lastname" />
                            <x-jet-input-error for="last_name" class="mt-2 text-red-500" />
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" type="email" class="block w-full mt-1" wire:model.defer="email" />
                            <x-jet-input-error for="email" class="mt-2 text-red-500" />
                        </div>

                        <!-- Gender -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="gender" value="{{ __('Gender') }}" />
                            <x-jet-input type="radio" class="block w-full mt-1" wire:model.defer="gender" />
                            <x-jet-input type="radio" class="block w-full mt-1" wire:model.defer="gender" />
                            <x-jet-input-error for="gender" class="mt-2 text-red-500" />
                        </div>

                        <!-- Mobile -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="mobile" value="{{ __('Mobile') }}" />
                            <x-jet-input id="mobile" type="text" class="block w-full mt-1" wire:model.defer="mobile" autocomplete="mobile" />
                            <x-jet-input-error for="mobile" class="mt-2 text-red-500" />
                        </div>

                        <!-- Roles -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="role" value="{{ __('Role') }}" />
                            @if (count($roles) > 0)
                            @foreach($roles as $role)
                                <div>
                                    <label>
                                        <input type="radio" wire:model="role_id" name="role_id"  value="{{ $role->id }}" />
                                    {{ $role->name }}</label>
                                </div>
                            @endforeach
                            @else
                                <div class="text-red-500">Roles are not available. Please add roles</div>
                            @endif
                            <x-jet-input-error for="role_id" class="mt-2 text-red-500" />
                        </div>
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <?php if(count($roles) > 0) { ?>
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5">
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
