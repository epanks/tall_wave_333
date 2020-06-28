<?php

namespace App\Http\Livewire\Paket;

use App\Balai;
use App\Kodeoutput;
use App\Ks;
use App\Paket;
use App\Ppk;
use App\Satker;
use App\Satoutcome;
use App\Satoutput;
use App\Sycmyc;
use Livewire\Component;

class PaketCreate extends Component
{
    public $databalai;
    public $balai_id;
    public $kdsatker;
    public $datasatoutput;
    public $datappk;
    public $dataks;
    public $datasycmyc;
    public $dataoutput;
    public $datasatoutcome;
    public $datasatker = [];

    public function mount()
    {
        $this->datasatoutput = Satoutput::get();
        $this->datasatoutcome = Satoutcome::get();
        $this->datappk = Ppk::get();
        $this->dataks = Ks::get();
        $this->datasycmyc = Sycmyc::get();
        $this->dataoutput = Kodeoutput::get();
        $this->databalai = Balai::where('wilayah_id', 3)->get();
        //$this->datasatker = Satker::where('wilayah_id', 3)->get();
        //$this->datasatker = $datasatker;
    }

    public function store()
    {
        //dd($this->nmpaket, $this->pagurmp, $this->balai_id, $this->kdsatker, $this->ta, $this->keuangan, $this->kdoutput);
        $this->validate([
            'nmpaket'    => 'required',
            'pagurmp'    => 'required',
            'ta'         => 'required',
            'balai_id'   => 'required',
            'kdsatker'   => 'required',
        ]);
        $paket = Paket::create([
            'nmpaket'    => $this->nmpaket,
            'pagurmp'    => $this->pagurmp,
            'ta'         => $this->ta,
            'balai_id'   => $this->balai_id,
            'kdsatker'   => $this->kdsatker,
            'kdoutput'   => $this->kdoutput,
            'trgoutput'   => $this->trgoutput,
            'trgoutcome'   => $this->trgoutcome,
        ])->progres()->create([
            'keuangan'   => $this->keuangan,
            'fisik'      => $this->fisik,
        ]);
        //dd($this->paket);
        session()->flash('success', 'Data berhasil disimpan');
        return redirect()->route('paket.list');
    }

    public function render()
    {
        if (!empty($this->balai_id)) {
            $this->datasatker = Satker::where('balai_id', $this->balai_id)->get();
        }
        return view('livewire.paket.paket-create');
    }
}
