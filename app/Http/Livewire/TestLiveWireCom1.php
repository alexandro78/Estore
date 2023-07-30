<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestLiveWireCom1 extends Component
{

    public $variableLtest1 = 0;
 
    protected $listeners = ['clickedElem' => 'doSomething'];
 
    public function doSomething($data)
    {
        $this->variableLtest1 = $data;
        $this->emit('variableUpdated', $data);
    }

    public function render()
    {
        return view('livewire.test-live-wire-com1');
    }
}
