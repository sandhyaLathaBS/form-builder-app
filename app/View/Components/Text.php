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
    public $qtnDetails;
    public $options;
    public $choice;
    public function __construct(array $qtnDetails = [],  int $choice = 0, array $options = [])
    {
        $this->qtnDetails = $qtnDetails;
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
        dd($this->qtnDetails);
        return view('components.text');
    }
}