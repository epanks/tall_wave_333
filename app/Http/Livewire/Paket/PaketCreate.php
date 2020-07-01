<?php

namespace App\Http\Livewire\Paket;

use App\Balai;
use App\Desa;
use App\Kabupaten;
use App\Kecamatan;
use App\Kodeoutput;
use App\Ks;
use App\Paket;
use App\Ppk;
use App\Progres;
use App\Provinsi;
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
    public $trgoutput;
    public $datasatoutput;
    public $datappk;
    public $apbnsbsn_id;
    public $fnf_id;
    public $trgoutcome;
    public $satoutcome_id;
    public $satoutput_id;
    public $fisik = 0;
    public $wilayah_id = 3;
    public $balai_id;
    public $ppk_id;
    public $ks_id;
    public $kdsatker;
    public $keuangan = 0;
    public $databalai;
    public $dataks;
    public $datasycmyc;
    public $dataoutput;
    public $datasatoutcome;
    public $dtdesa;
    public $dtkecamatan;
    public $dtkabupaten;
    public $dtprovinsi;

    // public $updateMode = false;
    public $datasatker = [];
    public $filterppk = [];

    public function mount()
    {
        $this->dtdesa = Desa::get();
        $this->dtkecamatan = Kecamatan::get();
        $this->dtkabupaten = Kabupaten::where('wilayah_id', 3)->get();
        $this->dtprovinsi = Provinsi::where('wilayah_id', 3)->get();
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
            'ppk_id'   => $this->ppk_id,
            'ks_id'   => $this->ks_id,
            'sycmyc_id'   => $this->sycmyc_id,
            'trgoutcome'   => $this->trgoutcome,
            'wilayah_id'   => $this->wilayah_id,
            'kdprovinsi' => $this->kdprovinsi,
            'kdkabupaten' => $this->kdkabupaten,
            'kdkecamatan' => $this->kdkecamatan,
            'kddesa' => $this->kddesa,
        ]);
        $this->paketId = $paket->id;
        $progres = Progres::create([
            'keuangan'   => $this->keuangan,
            'fisik'      => $this->fisik,
            'paket_id' => $this->paketId,
            'balai_id' => $this->balai_id,
        ]);
        //dd($progres);
        session()->flash('success', 'Data berhasil disimpan');
        return redirect()->route('paket-list');
    }

    public function render()
    {
        if (!empty($this->balai_id)) {
            $this->datasatker = Satker::where('balai_id', $this->balai_id)->get();
        }
        if (!empty($this->kdsatker)) {
            $this->filterppk = Ppk::where('kdsatker', $this->kdsatker)->get();
        }
        if (!empty($this->kdprovinsi)) {
            $this->filterkabupaten = Kabupaten::where('kdprovinsi', $this->kdprovinsi)->get();
        }
        if (!empty($this->kdkabupaten)) {
            $this->filterkecamatan = Kecamatan::where('kdkabupaten', $this->kdkabupaten)->get();
        }
        if (!empty($this->kdkecamatan)) {
            $this->filterdesa = Desa::where('kdkecamatan', $this->kdkecamatan)->get();
        }
        return view('livewire.paket.paket-create');
    }
}
