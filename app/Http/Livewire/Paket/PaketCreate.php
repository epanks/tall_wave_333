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
    public $nmpaket;
    public $pagurmp;
    public $ta;
    public $kdoutput;
    public $sycmyc_id;
    public $ks_id;
    public $trgoutput;
    public $satoutput_id;
    public $ppk_id;
    public $apbnsbsn_id;
    public $fnf_id;
    public $trgoutcome;
    public $satoutcome_id;
    public $databalai;
    public $balai_id;
    public $kdsatker;
    public $datasatoutput;
    public $datappk;
    public $dataks;
    public $datasycmyc;
    public $dataoutput;
    public $datasatoutcome;
    public $updateMode = false;
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

    public function edit($id)
    {
        $editpaket = Paket::findOrFail($id);
        $this->paket_id = $id;
        $this->nmpaket = $editpaket->nmpaket;
        $this->pagurmp = $editpaket->pagurmp;
        $this->ta = $editpaket->ta;
        $this->trgoutput = $editpaket->trgoutput;
        $this->satoutput_id = $editpaket->satoutput_id;
        $this->trgoutcome = $editpaket->trgoutcome;
        $this->satoutcome_id = $editpaket->satoutcome_id;
        $this->ppg_id = $editpaket->ppg_id;
        $this->satoutcome_id = $editpaket->satoutcome_id;
        $this->balai_id = $editpaket->balai_id;
        $this->kdsatker = $editpaket->kdsatker;
        $this->kdoutput = $editpaket->kdoutput;
        $this->kdprovinsi = $editpaket->kdprovinsi;
        $this->kdkabupaten = $editpaket->kdkabupaten;
        $this->kdkecamatan = $editpaket->kdkecamatan;
        $this->kddesa = $editpaket->kddesa;
        $this->wilayah_id = $editpaket->wilayah_id;
        $this->fnf_id = $editpaket->fnf_id;
        $this->ks_id = $editpaket->ks_id;
        $this->apbnsbsn_id = $editpaket->apbnsbsn_id;
        $this->sycmyc_id = $editpaket->sycmyc_id;
    }

    public function update(Request $request, $id)
    {
        $updatepaket = Paket::find($id);
        $updatepaket->update($request->all());

        return redirect()->back();
    }

    public function delete($id)
    {
        Paket::find($id)->delete();
        session()->flash('message', 'Paket Deleted Successfully.');
    }

    public function render()
    {
        if (!empty($this->balai_id)) {
            $this->datasatker = Satker::where('balai_id', $this->balai_id)->get();
        }
        return view('livewire.paket.paket-create');
    }
}
