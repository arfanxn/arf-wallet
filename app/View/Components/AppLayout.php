<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title, $navbarTop, $navbarBottom;

    public function __construct($title = "Title", $navbarTop = true, $navbarBottom = true)
    {
        $this->title = $title;
        $this->navbarTop = $navbarTop;
        $this->navbarBottom = $navbarBottom;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.app');
    }
}
