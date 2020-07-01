<?php

namespace App\Http\Livewire\Paket;

use App\Apbnsbsn;
use App\Balai;
use App\Desa;
use App\Fnf;
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

class PaketUpdate extends Component
{
    public $paketId, $nmpaket, $pagurmp, $ta, $trgoutput, $satoutput_id, $trgoutcome, $satoutcome_id, $balai_id, $kdsatker, $kdprovinsi, $kdkabupaten, $kdkecamatan, $kddesa, $kdoutput, $wilayah_id, $fnf_id, $ks_id, $apbnsbsn_id, $sycmyc_id,  $keuangan, $fisik, $ppk_id;
    //public $listsatker;
    public $dtbalai, $dtsatker, $dtsatoutput, $dtdesa, $dtkecamatan, $dtkabupaten, $dtprovinsi, $dtkdoutput, $dtapbnsbsn, $dtsycmyc, $datapaket, $dtsatoutcome, $dtfnf, $dtks, $dtoutput;

    public function mount($id)
    {

        $this->dtbalai = Balai::where('wilayah_id', 3)->get();
        $this->dtsatker = Satker::where('wilayah_id', 3)->get();
        $this->dtsatoutput = Satoutput::get();
        $this->dtsatoutcome = Satoutcome::get();
        $this->dtdesa = Desa::get();
        $this->dtkecamatan = Kecamatan::get();
        $this->dtkabupaten = Kabupaten::where('wilayah_id', 3)->get();
        $this->dtprovinsi = Provinsi::where('wilayah_id', 3)->get();
        $this->dtkdoutput = Kodeoutput::get();
        $this->dtapbnsbsn = Apbnsbsn::get();
        $this->dtsycmyc = Sycmyc::get();
        $this->dtfnf = Fnf::get();
        $this->dtks = Ks::get();
        //$this->dtoutput = Kdoutput::get();
        $datapaket = Paket::with('balai', 'satker', 'kodeoutput', 'satoutcome', 'satoutput', 'fnf', 'ks', 'apbnsbsn', 'sycmyc', 'desa', 'kabupaten', 'provinsi', 'kecamatan', 'progres')->find($id);
        $this->paketId = $datapaket->id;
        $this->nmpaket = $datapaket->nmpaket;
        $this->pagurmp = $datapaket->pagurmp;
        $this->ta = $datapaket->ta;
        $this->trgoutput = $datapaket->trgoutput;
        $this->satoutput_id = $datapaket->satoutput_id;
        $this->trgoutcome = $datapaket->trgoutcome;
        $this->satoutcome_id = $datapaket->satoutcome_id;
        $this->balai_id = $datapaket->balai_id;
        $this->ppk_id = $datapaket->ppk_id;
        $this->kdsatker = $datapaket->kdsatker;
        $this->kdprovinsi = $datapaket->kdprovinsi;
        $this->kdkabupaten = $datapaket->kdkabupaten;
        $this->kdkecamatan = $datapaket->kdkecamatan;
        $this->kddesa = $datapaket->kddesa;
        $this->kdoutput = $datapaket->kdoutput;
        $this->wilayah_id = $datapaket->wilayah_id;
        $this->fnf_id = $datapaket->fnf_id;
        $this->ks_id = $datapaket->ks_id;
        $this->apbnsbsn_id = $datapaket->apbnsbsn_id;
        $this->sycmyc_id = $datapaket->sycmyc_id;
        $this->absah = $datapaket->absah;
        $this->datapaket = $datapaket;
        //$this->listsatker = $datapaket->satker;
        // $this->datasatoutput = $datapaket->satoutput;
        //dd($this->databalai);
    }

    public function store()
    {
        $this->validate([
            'nmpaket'    => 'required',
            'pagurmp'    => 'required',
            'ta'         => 'required',
            'balai_id'   => 'required',
            'kdsatker'   => 'required',
        ]);
        if ($this->paketId) {
            $datapaket = Paket::find($this->paketId);
            if ($datapaket) {
                $datapaket->update([
                    'nmpaket' => $this->nmpaket,
                    'pagurmp' => $this->pagurmp,
                    'ta' => $this->ta,
                    'trgoutput' => $this->trgoutput,
                    'satoutput_id' => $this->satoutput_id,
                    'trgoutcome' => $this->trgoutcome,
                    'satoutcome_id' => $this->satoutcome_id,
                    'ppk_id' => $this->ppk_id,
                    'balai_id' => $this->balai_id,
                    'kdsatker' => $this->kdsatker,
                    'kdprovinsi' => $this->kdprovinsi,
                    'kdkabupaten' => $this->kdkabupaten,
                    'kdkecamatan' => $this->kdkecamatan,
                    'kddesa' => $this->kddesa,
                    'kdoutput' => $this->kdoutput,
                    'wilayah_id' => $this->wilayah_id,
                    'fnf_id' => $this->fnf_id,
                    'ks_id' => $this->ks_id,
                    'apbnsbsn_id' => $this->apbnsbsn_id,
                    'sycmyc_id' => $this->sycmyc_id,
                ]);
            }
        }

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
        // dd($this->filterdesa);
        return view('livewire.paket.paket-update');
    }
}
