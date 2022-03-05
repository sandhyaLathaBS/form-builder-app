<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Text extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $qtnDetails;
    private $options;
    private $choice;
    public function __construct($Qtn, $choice, $options)
    {
        $this->qtnDetails = $Qtn;
        $this->options = $options;
        $this->choice = $choice;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.text');
    }
}