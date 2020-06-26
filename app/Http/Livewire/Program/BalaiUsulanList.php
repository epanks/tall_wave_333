<?php

namespace App\Http\Livewire\Program;

use App\Balai;
use Livewire\Component;

class BalaiUsulanList extends Component
{
    public function render()
    {
        $databalai = Balai::where([
                'wilayah_id' => 3
            ])
            ->whereHas('paket', function ($query) {
                $query->whereta(2021);
            })
            ->paginate(10);
        return view('livewire.program.balai-usulan-list', compact('databalai'));
    }
}
