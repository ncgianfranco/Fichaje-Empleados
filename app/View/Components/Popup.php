<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Popup extends Component
{
    public $target;
    public $title;
    public $body;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $body, $target)
    {
        $this->title = $title;
        $this->body = $body;
        $this->target= $target;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.popup');
    }
}
