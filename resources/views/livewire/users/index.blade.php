@if(Request::is('users'))
<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Users
    </h2>
</x-slot>
@endif
<div class="">
    <div class="max-w-6xl py-2 mx-auto sm:px-6 lg:px-8">
        <div class="">

            <div class="block mb-8 text-right">
                <button wire:click="create()" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">Add User</button>
            </div>
            @if($isOpen)
                @if($isCreate)
                    @include('livewire.users.create')
                @elseif ($isEdit)
                    @include('livewire.users.edit')
                @elseif ($isUpdatePassword)
                    @include('livewire.users.password')
                @endif
                {{-- @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
                @endif --}}

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
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-blue-200">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-blue-200">
                                            Role
                                        </th>
                                        <th scope="col" width="200" class="px-6 py-3 bg-blue-200">

                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $sequence++ }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $user->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $user->roles()->pluck('name')->implode("") }}</td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                            <button wire:click="edit({{ $user->id }})" class="mb-2 mr-2 font-medium text-blue-600 hover:text-blue-900 focus:outline-none"><img src="/img/edit.png" title="Edit" class="w-4" /></button>
                                            @if (Auth::id() != $user->id)
                                            <button wire:click="openPasswordScreen({{ $user->id }})" class="mb-2 mr-2 font-medium text-blue-600 hover:text-blue-900 focus:outline-none"><img src="/img/change_password.png" title="Update Password" class="w-4" /></button>
                                            @endif
                                            @php
                                                $userIsActive = $user->is_active;
                                                if($userIsActive == 1) $checked = 'checked';
                                                else $checked = '';
                                            @endphp
                                            @if (Auth::id() != $user->id)
                                            <input id="usr_{{ $user->id }}" type="checkbox" {{ $checked }} name="useractive_{{ $user->id }}" onclick="toggleUserActive(this, {{ $user->id }}, {{ $user->is_active }})" class="-mt-2" value="{{ $user->is_active }}"  />
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div id="sub_popup" class="fixed top-0 flex items-center justify-center hidden w-3/4 h-full left-60" style="background-color: rgba(0,0,0,.5);" x-data="{ uid: 0, checked: '', val: '' }">

                            <div id="sub_popup_content"
                                class="w-2/5 p-4 mx-2 text-left bg-white rounded shadow-xl h-1/4 md:p-4 lg:p-6 md:mx-0">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">

                                    </h3>
                                    <div id="sub_popup_text" class="mt-2 mb-4">
                                    </div>
                                </div>

                                <div class="w-3/6 mt-8 ml-24">
                                    <span class="flex rounded-md shadow-sm">
                                        <button id="save_option"
                                            @click="toggleUserStatus()"
                                            class="inline-flex justify-center w-full px-4 py-2 mr-4 text-white bg-blue-500 rounded hover:bg-blue-700">
                                            Yes
                                        </button>
                                        <button id="cancel_option"
                                            @click="hidePopup()"
                                            class="inline-flex justify-center w-full px-4 py-2 ml-4 text-white bg-blue-500 rounded hover:bg-blue-700">
                                            No
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
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
    @this.on('dispatchStatusMsg', (msg, color) => {
        show_banner(msg, color);
    });
});

function toggleUserActive(box, id, val) {
    document.getElementById('sub_popup').__x.$data.uid = id;
    document.getElementById('sub_popup').__x.$data.checked = box.checked;
    document.getElementById('sub_popup').__x.$data.val = val;

    if(!box.checked) {
        document.getElementById("sub_popup").classList.remove("hidden");
        document.getElementById("sub_popup_text").innerHTML = "Are you sure you want to deactivate this user?";
    }
    else {
        document.getElementById("sub_popup").classList.remove("hidden");
        document.getElementById("sub_popup_text").innerHTML = "Are you sure you want to activate this user?";
    }
}

function hidePopup() {
    document.getElementById("sub_popup").classList.add("hidden");
    let uid = document.getElementById('sub_popup').__x.$data.uid;
    let val = document.getElementById('sub_popup').__x.$data.val;
    document.getElementById("usr_"+uid).checked = val == 1?true:false;
}

function toggleUserStatus() {
    let uid = document.getElementById('sub_popup').__x.$data.uid;
    let checked = document.getElementById('sub_popup').__x.$data.checked;
    //console.log("UPDATE: " + uid + ' > ' + checked);
    @this.toggleUserState(uid, checked);
}
</script>
