@extends('layouts.main')

@section('title', 'Al-quran')

@section('content')
{{-- {{dd($ar)}} --}}
    <div class="container" style="margin-top: 100px">
        <div class="row justify-content-beetwen">
            <div class="col">
                <h3>Surah {{$ar->data->englishName}}</h3>
            </div>
            <div class="col text-right">
                <h3 class="mb-4">{{$ar->data->name}}</h3>
            </div>
        </div>
        <table class="table text-right mt-5">
            <tbody>
                @foreach ($ar->data->ayahs as $index => $ayah)
                <tr>
                    <td  class="pt-4">
                        <span class="ar">{{$ayah->text}}</span><br>
                        <p class="id text-left mt-3">{{$id->data->ayahs[$index]->text}}</p>
                    </td>
                    <td class="pt-4 ml-4"><h3>{{$ayah->numberInSurah}}</h3></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
