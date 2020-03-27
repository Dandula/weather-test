<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\WeatherParsingService;

class PageController extends Controller
{
    public function __call($name, $arguments)
    {
        if (view()->exists($name)) {
            return view($name, $arguments);
        } elseif (view()->exists($pageName = 'pages.' . $name)) {
            return view($pageName, $arguments);
        } else {
            abort(404);
        }
    }

    public function weather()
    {
        $data = WeatherParsingService::getWeatherData();

        return view('pages.weather')->with(['data' => $data]);
    }

    public function index()
    {
        return view('welcome');
    }
}
