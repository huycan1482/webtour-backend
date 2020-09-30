<?php

namespace App\Http\Controllers;

use App\Category;
use App\Position;
use App\Setting;
use App\Tour;
use App\Transport;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    protected $categories;
    protected $tours;
    protected $transports;
    protected $positions;
    protected $settings;

    public function __construct()
    {

        $this->categories = Category::where(['is_active' => 1])->orderBy('id', 'desc')->get();
        $this->tours = Tour::where(['is_active' => 1])->orderBy('id', 'desc')->get();
        $this->transports = Transport::where(['is_active' => 1])->get();
        $this->positions = Position::where(['is_active' => 1])->get();
        $this->settings = Setting::first();

        view()->share([
            'settings' => $this->settings,
            'categories' => $this->categories,
            'tours' => $this->tours,
            'transports' => $this->transports,
            'positions' => $this->positions,
        ]);
    }

    public function notfound () {
        return view('admin.notfound');
    }

}
