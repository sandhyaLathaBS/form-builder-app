<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Paswword extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'choice' => 0,
        'options' => [],
        'Qtn_details' => []
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $data['details'] = $this->config;
        return view('widgets.paswword', $data);
    }
}