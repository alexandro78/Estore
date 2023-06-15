<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SizeComponent extends Component
{
    public $variableForLiveWire1;

    protected $listeners = ['dataReceived' => 'handleData'];

    public function handleData($data)
    {
        $this->variableForLiveWire1 = $data;

        // Дополнительная обработка полученных данных
    }

    public function mount()
    {
        $this->variableForLiveWire1 = 8;
    }

    public function render()
    {
        return view('livewire.size-component')->with('variableForLiveWire1', $this->variableForLiveWire1);
    }
}
