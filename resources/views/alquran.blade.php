@extends('layouts/main')

@section('title', 'Al-quran')

@section('content')
    {{-- {{dd($data)}} --}}
    <div class="container mt-5">
        <h3>Al-Qur'an</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Letter to</th>
                    <th scope="col">Letter</th>
                    <th scope="col">Number of verses</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($data->data as $surah)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$surah->englishName}}</td>
                        <td>{{$surah->numberOfAyahs}}</td>
                        <td><a href="/alquran/<?= $i ?>" class="btn btn-primary">Read</a></td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
          </table>
    </div>
@endsection
