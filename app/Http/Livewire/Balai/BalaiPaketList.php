<?php

namespace App\Http\Livewire\Balai;

use App\Balai;
use App\Paket;
use Livewire\Component;
use Livewire\WithPagination;

class BalaiPaketList extends Component
{
    use WithPagination;
    public $databalaipaket;

    public function mount($id)
    {
        $this->databalaipaket = Paket::with('progres', 'balai', 'satker', 'kodeoutput', 'satoutcome', 'satoutput', 'fnf', 'ks', 'apbnsbsn', 'sycmyc', 'desa', 'kabupaten', 'provinsi', 'kecamatan')
            ->where([
                'balai_id' => $id,
                'ta' => 2020
            ])
            ->get();
    }

    public function render()
    {
        // $databalaipaket = Paket::where([
        //     'wilayah_id' => 3,
        //     'balai_id' => $id,
        //     'ta' => 2020
        // ]);
        //     ->paginate(10);
        //dd($this->databalaipaket);
        return view('livewire.balai.balai-paket-list', [
            'databalaipaket' => $this->databalaipaket
        ]);
    }
}
