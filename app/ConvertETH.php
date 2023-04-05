<?php
namespace app;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
class ConvertETH{

    private string $key='f953bc35f2bbcb7c029f6ab7960da9ac2212fa0dab48de045de332e42cb71b4f';
    private $client;

    public function __construct(){
        $this->client= new Client();
    }

    private function GetChangeRate(string $base,string $cible){
        $res = $this->client->request('GET', "https://min-api.cryptocompare.com/data/price?fsym={$base}&tsyms={$cible},EUR?api_key={$this->key}");
        if($res->getStatusCode()==200){
            return json_decode($res->getBody(),true);
        }
        else{
            throw new \Exception($res->getStatusCode());
        }
    }

    public function ETH_TO_USD(float $amount){
        $rate=$this->GetChangeRate('ETH','USD')['USD'];
        
        $converted=$amount * $rate;

        return $converted;
    }




}