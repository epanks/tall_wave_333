<?php

namespace App\Http\Livewire\Balai;

use App\Balai;
use Livewire\Component;
use Livewire\WithPagination;

class BalaiList extends Component
{
    use WithPagination;

    public function render()
    {
        $databalai = Balai::with('paket', 'progres')
            ->where([
                'wilayah_id' => 3
            ])
            ->whereHas('paket', function ($query) {
                $query->whereta(2020);
            })
            ->paginate(10);
        return view('livewire.balai.balai-list', compact('databalai'));
    }
}
