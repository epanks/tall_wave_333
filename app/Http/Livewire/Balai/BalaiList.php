<?php

namespace App\Http\Livewire\Balai;

use App\Balai;
use Livewire\Component;
use Livewire\WithPagination;

class BalaiList extends Component
{
    use WithPagination;

    //public $search;

    public function render()
    {
        $databalai = Balai::where('wilayah_id', 3)->paginate(10);
        //dd($databalai);
        // $searchTerm = '%' . $this->search . '%';
        // $dataSearch = Balai::where('nmnmbalai', 'like', $searchTerm)->where('wilayah_id', 3)->paginate(10);
        return view('livewire.balai.balai-list', compact('databalai'));
    }
}
