<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Permission;

class Permissions extends Component
{
    public function render()
    {
        return view('livewire.permissions.index');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->permissions = Permission::get();
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

    private function resetInputFields(){
        $this->name = '';
        $this->permission_id = '';
    }

    public function store()
    {
        if($this->permission_id) {
            $this->validate([
                'name' => ['required','max:90', Rule::unique('permissions')->ignore($this->permission_id)],
            ],[
                'name.required' => 'The title field is required',
                'name.max' => 'The title may not be greater than 90 characters',
                'name.unique' => 'The title has already been taken',
            ]);
        } else {
            $this->validate([
                'name' => 'required|max:90|unique:permissions',
            ],[
                'name.required' => 'The title field is required',
                'name.max' => 'The title may not be greater than 90 characters',
                'name.unique' => 'The title has already been taken',
            ]);
        }

        Permission::updateOrCreate(['id' => $this->permission_id], [
            'name' => $this->name,
            'isFieldPermission' => $this->isPermissionRelatedField
        ]);

        $message = $this->permission_id ? 'Permission updated successfully' : 'Permission created successfully';
        $this->emit('showStatusMsg', $message, "green");

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $this->permission_id = $id;
        $this->name = $permission->name;
        $this->isPermissionRelatedField = $permission->isFieldPermission;

        $this->openModal();
    }

    public function delete($id)
    {
        Permission::find($id)->delete();
        $this->emit('showStatusMsg', 'Permission deleted successfully', "green");
    }
}
