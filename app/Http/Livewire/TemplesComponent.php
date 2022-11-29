<?php

namespace App\Http\Livewire;

use App\Models\Temple;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TemplesComponent extends Component
{
    public $temple_id, $templeInfo;

    public $name, $description, $visibility, $status, $featured, $address, $city, $state, $zipcode;

    public function mount($id = null)
    {
        if ($id != '') {
            $this->temple_id = $id;
        }
    }

    public function render()
    {
        if ($this->temple_id != '') {
            $this->templeInfo = $this->getTempleInfo();
            return view('livewire.temples.view')->with('sequence', 1);
        } else {
            //$this->temples = Temple::all();
            $temples = Temple::paginate(1);
            return view('livewire.temples.list', ['temples' => $temples]);
        }
    }

    public function viewTempleInfo(int $templeId)
    {
        return redirect()->to('/temple/' . $templeId);
    }

    public function getTempleInfo()
    {
        $templeInfo = Temple::where('id', $this->temple_id)->get();
        return isset($templeInfo[0]) ? $templeInfo[0] : '';
        /* $this->temple_id = $temple->id;
        $this->name = $temple->name;
        $this->description = $temple->description;
        $this->visibility = $temple->visibility;
        $this->status = $temple->status;
        $this->featured = $temple->featured;
        $this->address = $temple->address;
        $this->city = $temple->city;
        $this->state = $temple->state;
        $this->zipcode = $temple->zipcode; */
    }
}