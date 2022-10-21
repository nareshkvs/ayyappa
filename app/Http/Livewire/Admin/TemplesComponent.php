<?php

namespace App\Http\Livewire\Admin;

use App\Models\Temple;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TemplesComponent extends Component
{
    public $temple_id, $isOpen, $isTimings;

    public $name, $description, $visibility, $status, $featured, $address, $city, $state, $zipcode;

    public function render()
    {
        $this->temples = Temple::all();
        return view('livewire.temples.index')->with('sequence', 1);;
    }

    public function create()
    {
        $this->resetInputFields();

        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isTimings = false;
        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function resetInputFields(){
        $this->name = '';
        $this->temple_id = '';
        $this->description = '';
        $this->visibility = '';
        $this->status = '';
        $this->featured = '';
        $this->address = '';
        $this->city = '';
        $this->state = '';
        $this->zipcode = '';
    }

    public function store()
    {
        if($this->temple_id) {
            $this->validate([
                'name' => ['required','max:90'],
                'visibility' => ['required'],
                'status' => ['required'],
                'address' => ['required'],
            ],[
                'name.required' => 'The title field is required',
                'name.max' => 'The title may not be greater than 90 characters',
                'name.unique' => 'The title has already been taken',
            ]);
        } else {
            $this->validate([
                'name' => ['required','max:90'],
                'visibility' => ['required'],
                'status' => ['required'],
                'address' => ['required'],
            ],[
                'name.required' => 'The title field is required',
                'name.max' => 'The title may not be greater than 90 characters',
                'name.unique' => 'The title has already been taken',
            ]);
        }

        $temple = Temple::firstOrNew(['id' => $this->temple_id]);
        $temple->name = $this->name;
        $temple->slug = str_replace(' ', '-', $this->name);
        $temple->description = $this->description;
        $temple->visibility = $this->visibility;
        $temple->status = $this->status;
        $temple->featured = $this->featured;
        $temple->address = $this->address;
        $temple->city = $this->city;
        $temple->state = $this->state;
        $temple->zipcode = $this->zipcode;
        $temple->created_by = auth()->user()->id;
        $temple->updated_by = auth()->user()->id;
        $temple->save();

        /*Temple::updateOrCreate(['id' => $this->temple_id], [
            'name' => $this->name,
            'description' => $this->description,
            'visibility' => $this->visibility,
            'status' => $this->status,
            'featured' => $this->featured,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zipcode,
        ]);*/

        $message = $this->temple_id ? 'Temple details updated successfully' : 'Temple details created successfully';
        $this->emit('showStatusMsg', $message, "green");

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $temple = Temple::findOrFail($id);
        $this->temple_id = $id;
        $this->name = $temple->name;
        $this->description = $temple->description;
        $this->visibility = $temple->visibility;
        $this->status = $temple->status;
        $this->featured = $temple->featured;
        $this->address = $temple->address;
        $this->city = $temple->city;
        $this->state = $temple->state;
        $this->zipcode = $temple->zipcode;

        $this->openModal();
    }

    public function delete($id)
    {
        Temple::find($id)->delete();
        $this->emit('showStatusMsg', 'Permission deleted successfully', "green");
    }

    public function viewTempleTimings($id) {
        $this->isTimings = true;
        dd('Test');
    }
}
