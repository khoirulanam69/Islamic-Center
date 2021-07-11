@extends('layouts/main')

@section('title', 'Jadwal Sholat')

@section('content')
<div class="container" style="margin-top: 100px">
    <form action="/jadwalsholat" method="POST" class="text-right">
        @csrf
        <div class="row justify-content-end">
            <div class="col-lg-3">
                @if ($city)
                <input type="text" name="city" value="<?= $city?>" required>
                @else
                <input type="text" name="city" value="Malang" required>
                @endif
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
            <h5>Today</h5>
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
                    @if ($response == "Internal Server Error")
                        <td>{{$response}}</td>
                    @else
                        <td>{{$response->results->datetime[0]->times->Fajr}}</td>
                        <td>{{$response->results->datetime[0]->times->Dhuhr}}</td>
                        <td>{{$response->results->datetime[0]->times->Asr}}</td>
                        <td>{{$response->results->datetime[0]->times->Maghrib}}</td>
                        <td>{{$response->results->datetime[0]->times->Isha}}</td>
                    </tr>
                    @endif
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
