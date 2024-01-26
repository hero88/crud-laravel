<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

 
class DashboardController extends Controller
{
    
    public function index(Request $request, string $i="1")
    {
        // ...
        $params = $request->all();

        if ($i<1) $i=1;
        $start = (($i-1)*20)+1;

        $response = Http::get('https://api.coinmarketcap.com/data-api/v3/cryptocurrency/listing', [
            'start' => $start,
            'limit' => 20,
            'sortBy' => 'market_cap',
            'sortType' => 'desc',
            'convert' => 'USD',
            'cryptoType' => 'all',
            'tagType' => 'all',
            'audited' => false,
        ]);

        $values = [
            'params' => $params,

            'items' => isset($response['data']) && isset($response['data']['cryptoCurrencyList'])? $response['data']['cryptoCurrencyList'] : [],

            'totalCount' => isset($response['data']) && isset($response['data']['totalCount'])? $response['data']['totalCount'] : 0,

            'itmStart' => $start,

            'current' => $i,

        ];

        // echo '<pre>';var_dump($values);die;

        return view('home', $values);
    }


}