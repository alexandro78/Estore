<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestLiveWireCom2 extends Component
{
    public $variableLtest2 = 2;

    protected $listeners = ['variableUpdated' => 'updateVariable'];

    public function updateVariable($data)
    {
        $this->variableLtest2 = $data;
    }

    public function render()
    {
        return view('livewire.test-live-wire-com2');
    }
}
