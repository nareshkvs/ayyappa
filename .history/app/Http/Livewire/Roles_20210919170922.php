<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use App\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Roles extends Component
{
    public $isOpen = 0;
    public $name, $role_id, $role, $roles;
    public $permissions = [];
    public $permissionList = [];


    public function render()
    {
        //$this->authoriseUserHasRole('Admin');

        $roles = DB::table('roles')
        ->leftJoin('group_role', 'roles.id', '=', 'group_role.role_id')
        ->leftJoin('groups', 'group_role.group_id', '=', 'groups.id')
        ->select('roles.id', 'roles.name as role_name', 'roles.guard_name as group_name'))
        ->groupByRaw('roles.id')
        ->orderBy('roles.name')
        ->get();

        $this->roles = $roles;

        return view('livewire.roles.index', compact('roles'))->with('sequence', 1);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->permissions = Permission::all();

        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    protected $listeners = [
        'refreshRoles' => '$refresh',
    ];

    private function resetInputFields(){
        $this->name = '';
        $this->role_id = '';
        $this->permissionList = [];
    }

    public function store()
    {
        if($this->role_id) {
            $this->validate([
                'name' => ['required','max:90', Rule::unique('roles')->ignore($this->role_id)],
                'permissionList' => 'required',
            ],[
                'name.required' => 'The :attribute cannot be empty',
                'name.max' => 'The :attribute may not be greater than 90 characters',
                'permissionList.required' => 'Please select at least one permission',
            ]);
        } else {
            $this->validate([
                    'name' => 'required|max:90||unique:roles',
                    'permissionList' => 'required',
                ],[
                    'name.required' => 'The :attribute cannot be empty',
                    'name.max' => 'The :attribute may not be greater than 90 characters',
                    'permissionList.required' => 'Please select at least one permission',
                ]
            );
        }

        $role = Role::updateOrCreate(['id' => $this->role_id], [
            'name' => $this->name
        ]);

        $role->syncPermissions($this->permissionList);

        $message = $this->role_id ? 'Role updated successfully' : 'Role created successfully';

        $this->closeModal();
        $this->resetInputFields();

        $this->role = "";
        $this->emit('showStatusMsg', $message, "green");
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->role_id = $id;
        $this->name = $role->name;

        $this->role = $role;
        $this->permissions = Permission::get();
        $permissionList =  $role->getAllPermissions();
        $permissionKeys = $permissionList->modelKeys();
        if(count($permissionKeys) > 0)
            $this->permissionList = array_combine($permissionKeys, $permissionKeys);
        $this->openModal();
    }

    public function delete($id)
    {
        Role::find($id)->delete();
        $this->emit('showStatusMsg', 'Role deleted successfully', "green");
    }

    public function updatedPermissionList($value)
    {
        if (!$value) {
            $this->permissionList = array_filter($this->permissionList);
        }
    }
}
