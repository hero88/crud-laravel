@extends('layouts.master')

<style>
  <?php include "custom/css/home.css"?>
</style>


@section('content')
    <main role="main" class="container" id="home">
        <h4 class="mt-5 fw-bold">Today's Cryptocurrency Prices by Market Cap</h4>
        <div class="row mt-5">
            {{--<div class="d-flex w-25">
                <label for="numRow pe-2">Show row: </label> 
                <select name="numRow" class="form-select" aria-label="numRow">
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div> --}}
            <table class="table text-end align-middle">
                <thead>
                    <tr>
                        <th scope="col" class="text-center"></th>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-start">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">1h %</th>
                        <th scope="col">24h %</th>
                        <th scope="col">7d %</th>
                        <th scope="col">Market Cap</th>
                        <th scope="col">Volume(24h)</th>
                        <th scope="col">Circulating Supply</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $key=>$item)
                    <?php 
                        $quotes = $item['quotes'][0]; 
                        $convertVolume=(int)($quotes['volume24h']/$quotes['price']);
                        $lastPage = $totalCount%20 === 0? (int)($totalCount/20): (int)($totalCount/20)+1
                    ?>
                    <tr>
                        <th scope="row" class="text-center"><i class="fa-regular fa-star text-secondary"></i></th>
                        <td class="text-center">{{$key+$itmStart}}</td>
                        <td class="text-start fw-bold">
                            <img class="coin-logo" src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{$item['id']}}.png" loading="lazy" decoding="async" fetchpriority="low" alt="{{$item['symbol']}} logo">
                            {{$item['name']}} <span class="text-secondary">{{$item['symbol']}}</span>
                        </td>
                        <td>${{number_format($quotes['price'], $quotes['price']>=10?2:4)}}</td>
                        
                        @if($quotes['percentChange1h']>=0)
                        <td class="text-success"><i class="fa-solid fa-caret-up"></i> {{number_format(abs($quotes['percentChange1h']), 2)}}%</td>
                        @else
                        <td class="text-danger"><i class="fa-solid fa-caret-down"></i> {{number_format(abs($quotes['percentChange1h']), 2)}}%</td>
                        @endif
                        
                        @if($quotes['percentChange24h']>=0)
                        <td class="text-success"><i class="fa-solid fa-caret-up"></i> {{number_format(abs($quotes['percentChange24h']), 2)}}%</td>
                        @else
                        <td class="text-danger"><i class="fa-solid fa-caret-down"></i> {{number_format(abs($quotes['percentChange24h']), 2)}}%</td>
                        @endif
                        
                        @if($quotes['percentChange7d']>=0)
                        <td class="text-success"><i class="fa-solid fa-caret-up"></i> {{number_format(abs($quotes['percentChange7d']), 2)}}%</td>
                        @else
                        <td class="text-danger"><i class="fa-solid fa-caret-down"></i> {{number_format(abs($quotes['percentChange7d']), 2)}}%</td>
                        @endif

                        <td>${{number_format($quotes['marketCap'], $quotes['marketCap']>=10?0:4)}}</td>
                        <td>${{number_format($quotes['volume24h'], $quotes['volume24h']>=10?0:4)}} <p class="text-secondary">{{number_format($convertVolume, $convertVolume<=9?4:0)}} BTC</p></td>
                        <td>{{number_format($item['circulatingSupply'], $item['circulatingSupply']<=9?4:0)}} {{$item['symbol']}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between mb-5">
                <div class="text-secondary">Showing {{$itmStart}} - {{$current == $lastPage? $totalCount:$itmStart+20-1}} out of {{$totalCount}}</div>
                <ul class="list-group list-group-horizontal">
                    
                    @if($current<=5)
                        @for($i=1; $i<=6; $i++)
                        <a class="list-group-item {{$i==$current? 'active':''}}" href="{{url('home/'.$i)}}">{{$i}}</a>
                        @endfor
                        <a class="list-group-item"><i class="fa-solid fa-ellipsis"></i></a>
                        <a class="list-group-item" href="{{url('home/'.$lastPage)}}">{{$lastPage}}</a>
                    @elseif($current+5>$lastPage)
                        <a class="list-group-item }}" href="{{url('home/')}}">1</a>
                        <a class="list-group-item"><i class="fa-solid fa-ellipsis"></i></a>
                        @for($i=$lastPage-5; $i<=$lastPage; $i++)
                        <a class="list-group-item {{$i==$current? 'active':''}}" href="{{url('home/'.$i)}}">{{$i}}</a>
                        @endfor
                    @else
                        <a class="list-group-item }}" href="{{url('home/')}}">1</a>
                        <a class="list-group-item"><i class="fa-solid fa-ellipsis"></i></a>
                        @for($i=$current-2; $i<=$current+2; $i++)
                        <a class="list-group-item {{$i==$current? 'active':''}}" href="{{url('home/'.$i)}}">{{$i}}</a>
                        @endfor
                        <a class="list-group-item"><i class="fa-solid fa-ellipsis"></i></a>
                        <a class="list-group-item" href="{{url('home/'.$lastPage)}}">{{$lastPage}}</a>
                    @endif
                </ul>
                {{-- <div class="d-flex w-25">
                    <label for="numRow" class="pe-2 w-50 align-middle">Show row: </label> 
                    <select name="numRow" class="form-select" aria-label="numRow">
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div> --}}
            </div>
        </div>
    </main>
@endsection
