<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Actions\Fortify\PasswordValidationRules;

class Users extends Component
{
    use PasswordValidationRules;
    use SoftDeletes;


    public $isOpen = 0, $isCreate = 0, $isEdit = 0, $isUpdatePassword = 0;
    public $name, $user_id, $email, $bio, $isActive, $role, $password, $password_confirmation;
    public $user;
    public $roles = [];
    public $role_id = '';

    public function mount()
    {
        $this->authoriseUserHasRole('Admin');
    }

    public function render()
    {
        $users = User::all()->sortBy('name');
        return view('livewire.users.index', compact('users'))->with('sequence', 1);
    }

    public function toggleUserState($id, $status) {
        $status == ''?0:1;
        $msg = $status == 1?'activated':'deactivated';
        $user = User::findOrFail($id);
        $user->is_active = $status;
        $user->save();

        $this->emit('showStatusMsg', "User ".$msg." successfully", "green");
    }

    public function create()
    {
        $this->isCreate = true;
        $this->resetInputFields();
        $this->roles = Role::get();

        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isCreate = false;
        $this->isEdit = false;
        $this->isUpdatePassword = false;
        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function resetInputFields(){
        $this->reset(['name', 'user_id', 'role_id', 'email', 'password', 'password_confirmation']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'role_id' => ['required']
            ]
        );

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'bio' => '',
        ]);

        $user->assignRole($this->role_id);

        if($this->user_id) {
            $this->emit('showStatusMsg', "User updated successfully", "green");
        }
        else {
            $this->emit('showStatusMsg', "User created successfully", "green");
        }

        if($this->user_id) {
            $this->emit('showStatusMsg', "User updated successfully", "green");
        }
        else {
            $this->emit('showStatusMsg', "User created successfully", "green");
        }

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $this->resetInputFields();

        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;

        $this->roles = Role::get();
        if($user->hasAnyRole(Role::all()))
            $this->role_id = $user->roles->first()->id;
        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        $this->emit('showStatusMsg', "User deleted successfully", "green");
    }

    public function update()
    {
        $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
                'role_id' => ['required']
            ]
        );

        $user = User::findOrFail($this->user_id);
        $user->forceFill([
                'name' => $this->name,
                'email' => $this->email,
            ])->save();

        $user->syncRoles([$this->role_id]);
        $this->emit('settings:updaterole', $this->role_id);

        if($this->user_id) {
            $this->emit('showStatusMsg', "User updated successfully", "green");
        }
        else {
            $this->emit('showStatusMsg', "User created successfully", "green");
        }

        $this->closeModal();
        $this->resetInputFields();
    }

    public function openPasswordScreen($id) {
        $this->isUpdatePassword = true;
        $this->user_id = $id;
        $this->openModal();
    }

    public function updatePassword() {

        $this->validate([
            'password' => $this->passwordRules(),
            ]
        );

        $user = User::findOrFail($this->user_id);

        if($user) {
            $user->forceFill([
                'password' => Hash::make($this->password),
            ])->save();

            $this->emit('dispatchStatusMsg', "Password updated successfully", "green");
        } else {
            $this->emit('dispatchStatusMsg', "User not found", "red");
        }

        $this->closeModal();
        $this->resetInputFields();
    }
}
