<?php

namespace App\Http\Livewire\Balai;

use App\Balai;
use App\Paket;
use Livewire\Component;

class BalaiPaketList extends Component
{
    public $balai_id = 'id';
    public function mount($id)
    {
        $balai = Balai::find($id);
    }
    public function render()
    {
        $databalaipaket = Paket::with('progres', 'balai', 'satker', 'kodeoutput', 'satoutcome', 'satoutput', 'fnf', 'ks', 'apbnsbsn', 'sycmyc', 'desa', 'kabupaten', 'provinsi', 'kecamatan')
            ->where([
                'balai_id' => $this->balai_id,
                'ta' => 2020
            ])
            ->get();
        dd($databalaipaket);
        return view('livewire.balai.balai-paket-list', compact('databalaipaket'));
    }
}
