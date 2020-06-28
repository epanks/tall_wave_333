<?php

namespace App\Http\Livewire\Paket;

use App\Paket;
use Livewire\Component;

class PaketList extends Component
{
    public function render()
    {
        $datapaket = Paket::with('progres', 'balai')->where('wilayah_id', 3)->where('ta', 2020)->paginate(10);
        return view('livewire.paket.paket-list', compact('datapaket'));
    }
}
