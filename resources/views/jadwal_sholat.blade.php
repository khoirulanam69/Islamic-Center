@extends('layouts/main')

@section('title', 'Jadwal Sholat')

@section('content')
{{-- {{dd($cityname)}} --}}
<div class="container" style="margin-top: 100px">
    <form action="/jadwalsholat" method="POST" class="text-right">
        @csrf
        <div class="row justify-content-end">
            <div class="col-lg-3">
                <select name="city" id="city" class="p-1" style="width: 250px">
                    <option value="775" selected>KOTA MALANG</option>
                    @foreach ($citys->kota as $city)
                    @if ($city->id == $idcity)
                        <option value="{{$city->id}}" selected>{{$city->nama}}</option>
                    @endif
                        <option value="{{$city->id}}">{{$city->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3">
                @if (!$tgl)
                <input type="date" value="<?= $curtime?>" name="tgl">
                @else
                <input type="date" value="<?= $tgl?>" name="tgl">
                @endif
                <button type="submit">Cari</button>
            </div>
        </div>
    </form>
    <div class="row mt-5 ">
        <div class="col-sm-4">
            <h3>Current time</h3>
            <div class="analog mt-5">
                <span></span>
                <div class="hour">
                    <div class="hr" id="hr"></div>
                </div>
                <div class="minute">
                    <div class="mn" id="mn"></div>
                </div>
                <div class="second">
                    <div class="sc" id="sc"></div>
                </div>
            </div>
            <div class="digital mt-4">
                <h1 id="time"></h1>
            </div>
        </div>
        <div class="col-sm-8">
            <h3>Prayer schedule</h3>
            @if (!$tgl || $tgl == $curtime)
                <h5 class="mt-5">Today</h5>
            @else
                <h5 class="mt-5">{{$tgl}}</h5>
            @endif
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Subuh</th>
                        <th scope="col">Dzuhur</th>
                        <th scope="col">Ashar</th>
                        <th scope="col">Maghrib</th>
                        <th scope="col">Isya'</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$schedule->jadwal->data->subuh}}</td>
                        <td>{{$schedule->jadwal->data->dzuhur}}</td>
                        <td>{{$schedule->jadwal->data->ashar}}</td>
                        <td>{{$schedule->jadwal->data->maghrib}}</td>
                        <td>{{$schedule->jadwal->data->isya}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function time() {
        let  today = new Date();
        let hours = today.getHours();
        let minute = today.getMinutes();
        let second = today.getSeconds();

        minute = checkTime(minute);
        second = checkTime(second);

        document.getElementById('time').innerHTML = hours + ":" + minute + ":" + second;

        let t = setTimeout(time, 500)
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }
        return i;
    }
</script>
<script>
    const hr = document.getElementById('hr');
    const mn = document.getElementById('mn');
    const sc = document.getElementById('sc');

    setInterval(() => {
        let day = new Date();
        let hh = day.getHours() * 30;
        let mm = day.getMinutes() * 6;
        let ss = day.getSeconds() * 6;

        hr.style.transform = `rotateZ(${hh+(mm/12)}deg)`;
        mn.style.transform = `rotateZ(${mm}deg)`;
        sc.style.transform = `rotateZ(${ss}deg)`;
    })
</script>
@endsection
