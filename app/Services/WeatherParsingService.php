<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Sunra\PhpSimple\HtmlDomParser;
use simplehtmldom_1_5\simple_html_dom;

class WeatherParsingService
{
    private const WEATHER_URL = 'https://www.gismeteo.ua/weather-zaporizhia-5093/';

    static public function getWeatherData(): array
    {
        $dom = self::getWeatherPage();

        return self::parseWeatherPage($dom);
    }

    static private function getWeatherPage(): simple_html_dom
    {
        $response = Http::withHeaders([
            'User-Agent'    => 'testing/1.0',
            'Cache-Control' => 'no-cache',
        ])->get(self::WEATHER_URL);

        return HtmlDomParser::str_get_html($response->body());

        return self::parseWeather($dom);
    }

    static private function parseWeatherPage(simple_html_dom $dom): array
    {
        $container = $dom->find('.forecast_frame .widget__container', 0);

        $data = [];

        foreach ($container->find('.widget__row_time > .widget__item') as $key => $item) {
            $hour = $item->find('.w_time > span', 0)->innertext;
            $minute = $item->find('.w_time > sup', 0)->innertext;

            $data[$key]['time'] = Carbon::now()
                ->setHour($hour)
                ->setMinute($minute)
                ->setSecond(0)
                ->format('H:i');
        }

        foreach ($container->find('.widget__row_icon > .widget__item') as $key => $item) {
            $atmosphere = $item->find('.w_icon > span', 0)->{'data-text'};

            $data[$key]['atmosphere'] = $atmosphere;
        }

        foreach ($container->find('.widget__row_temperature .value') as $key => $item) {
            $temperature = $item->find('.unit_temperature_c', 0)->innertext;

            $data[$key]['temperature'] = $temperature . '°C';
        }

        foreach ($container->find('.widget__row_wind-or-gust > .widget__item') as $key => $item) {
            $wind = trim($item->find('.unit_wind_m_s', 0)->innertext);

            $data[$key]['wind'] = $wind . ' м/с';
        }

        foreach ($container->find('.widget__row_precipitation > .widget__item') as $key => $item) {
            $precipitation = trim($item->find('.w_prec__value', 0)->innertext);

            $data[$key]['precipitation'] = $precipitation . ' мм';
        }

        return $data;
    }
}
