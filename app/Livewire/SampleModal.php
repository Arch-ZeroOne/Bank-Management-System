<?php

namespace App\Livewire;

use Livewire\Component;

class SampleModal extends Component
{
    public $isOpen = false;
    public function render()
    {
        return view('livewire.sample-modal');
    }
    public function openModal(){
    $this -> isOpen = true;
    }
    public function closeModal(){
        $this -> isOpen = false;
    }
}
