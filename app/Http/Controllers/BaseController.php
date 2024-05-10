<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $title = '';
    protected $route = '';

    public function curdInfo()
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        return $data;
    }
}
