<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function jadwalsholat(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $currentTime = date('Y-m-d');
        $tgl = $request->input('tgl');
        $idcity = $request->input('city');

        $citys = $client->get('https://api.banghasan.com/sholat/format/json/kota');
        $schedule = $client->get('https://api.banghasan.com/sholat/format/json/jadwal/kota/775/tanggal/' . $currentTime);

        if ($tgl && $idcity) {
            $schedule = $client->get('https://api.banghasan.com/sholat/format/json/jadwal/kota/' . $idcity . '/tanggal/' . $tgl);
        }

        $data = [
            'schedule' => json_decode($schedule->getBody()),
            'curtime' => $currentTime,
            'citys' => json_decode($citys->getBody()),
            'idcity' => $idcity,
            'tgl' => $tgl
        ];
        return view('jadwal_sholat', $data);
    }

    public function alquran(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $surah = $client->get('http://api.alquran.cloud/v1/surah');
        $data = ['data' => json_decode($surah->getBody())];
        return view('alquran', $data);
    }

    public function detailalquran(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client();
        $ar = $client->get('http://api.alquran.cloud/v1/surah/' . $id . '/quran-uthmani');
        $id = $client->get('http://api.alquran.cloud/v1/surah/' . $id . '/id.indonesian');
        $data = [
            'ar' => json_decode($ar->getBody()),
            'id' => json_decode($id->getBody()),
        ];
        return view('detail_alquran', $data);
    }

    public function kiblat()
    {
        return view('kiblat');
    }

    public function offline()
    {
        return view('offline');
    }
}
