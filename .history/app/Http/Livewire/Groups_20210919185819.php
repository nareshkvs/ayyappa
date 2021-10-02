<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Groups extends Component
{
    public $isOpen = 0;
    public $name, $group_id, $group, $groups, $userRole;
    public $roles = [];
    public $rolesList = [], $groupRolesList = [], $assignedRoles = [];

    public function mount() {
        $this->authoriseUserHasRole('Admin');

        $user_data = User::find(auth()->user()->id);
        $userRole = $user_data->roles()->pluck('name')->implode("");
        $this->userRole = $userRole;
    }

    public function render()
    {
        $groups = Group::all()->sortBy('name');
        $this->groups = $groups;
        return view('livewire.groups.index')->with('sequence', 1);
    }

    protected $listeners = [
        'createGroup' => 'create',
        'updateGroup' => 'store',
        'deleteGroup' => 'delete',
        'settings:updaterole' => 'updateUserRole',
        'refreshGroups' => 'refreshGroupData', //'$refresh'
    ];

    public function refreshGroupData() {
        $this->groups = Group::all();
    }

    public function updateUserRole($role_id) {
        $userRole = Role::where('id', $role_id)->first();
        $this->userRole = $userRole->name;
    }

    public function create()
    {
        $this->resetInputFields();

        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->roles = Role::get();
        if($this->group_id != '') {
            $rolesList =  Group::find($this->group_id)->roles;
            $groupRoles = [];
            foreach($rolesList as $groupRole) {
                $groupRoles[] = $groupRole->id;
            }
            $this->groupRolesList = $this->rolesList = $groupRoles;
        }

        $group_role_sql = "SELECT DISTINCT(role_id) FROM `group_role`";

        if($this->group_id != '') {
            $group_role_sql .= " where group_id <> ".$this->group_id." and role_id NOT IN (select role_id from group_role where group_id=".$this->group_id.")";
        }

        $groupAssignedRoles = DB::select($group_role_sql);

        $assignedRoles = [];
        foreach($groupAssignedRoles as $v) {
            $assignedRoles[] = $v->role_id;
        }
        $this->assignedRoles = $assignedRoles;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function resetInputFields(){
        $this->name = '';
        $this->group_id = '';
        $this->rolesList = [];
    }

    public function delete($id)
    {
        $group_id = Group::findOrFail($id);
        DB::table('group_role')->where('group_id', '=', $id)->delete();
        $group_id->delete();
        $this->group = null; // Important to clear model
        $this->emit('showStatusMsg', 'Group deleted successfully', "green");
    }

    public function store($selectedRoles = null)
    {
        if($selectedRoles != '') {
            $this->rolesList = $selectedRoles;
        }

        if($this->group_id) {
            $validate = $this->validate([
                'name' => ['required','max:90', Rule::unique('groups')->ignore($this->group_id)],
                'rolesList' => 'required',
            ],[
                'name.required' => 'The :attribute cannot be empty',
                'name.max' => 'The :attribute may not be greater than 90 characters',
                'rolesList.required' => 'Please select at least one role',
            ]);
        } else {
            $validate = $this->validate([
                    'name' => ['required','max:90',Rule::unique("groups")],//->where('status', 1)],
                    'rolesList' => 'required',
                ],[
                    'name.required' => 'The :attribute cannot be empty',
                    'name.max' => 'The :attribute may not be greater than 90 characters',
                    'rolesList.required' => 'Please select at least one role',
                ]
            );
        }

        $role_ids = [];
        foreach($validate['rolesList'] as $role_id) {
            $role_ids[] = $role_id;
        }

        $group = Group::updateOrCreate(['id' => $this->group_id == ''?NULL:$this->group_id], [
            'name' => $this->name,
            'code' => str_replace(" ", "_", strtolower($this->name)),
        ]);
        $group_id = $group->id;

        if($group_id != '') {
            $group->roles()->sync($role_ids);
        }

        $message = $this->group_id ? 'Group updated successfully' : 'Group created successfully';
        $this->emit('showStatusMsg', $message, "green");

        $this->closeModal();
        $this->resetInputFields();
        $this->emitTo('roles', 'refreshRoles');
    }

    public function edit($id)
    {
        $group = Group::findOrFail($id);
        $this->group_id = $id;
        $this->name = $group->name;
        $this->group = $group;

        $this->openModal();
    }
}
