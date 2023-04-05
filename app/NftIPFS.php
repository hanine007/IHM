<?php namespace app;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;


class NftIPFS{

    private $token='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJkaWQ6ZXRocjoweEQwMTFlYmY1OEQ0MkM3NDk3YkY2N0ZBRTMwNTgxQWZkOTM1OTAzYzUiLCJpc3MiOiJuZnQtc3RvcmFnZSIsImlhdCI6MTY1MTkzMjgxNTEyOCwibmFtZSI6ImppbnhhcnQifQ.z1Ye8O3hTVuhK_0GN5g0_80CZZyabwRB5p4ez_8N_Ec';
    private string $host = "https://api.nft.storage";
    private $client;
 
    
    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->host]);
    }

    public function ListAll(){
        $headers = [
            'Authorization' => 'Bearer ' . $this->token,        
            'Accept'        => 'application/json',
        ];

        $response = $this->client->request('GET', '/', [
            'headers' => $headers
        ]);

        if($response->getStatusCode() == 200){
            return $response->getBody();
        }else{
            throw new \exception($response->getStatusCode());
        }
    }

    public function store($dir){
        $body = Utils::tryFopen('./SS/images/'.$dir, 'r');
        
        $headers = [
            'Authorization' => 'Bearer ' . $this->token,        
            'Accept'        => 'application/json',
            
        ];
       
        $response = $this->client->request('POST', '/upload', [
            'headers' => $headers,
            'body'=> $body
        ]);

        if($response->getStatusCode() == 200){
            return $response->getBody();
        }else{
            throw new \exception($response->getStatusCode());
        }
    }
       

    
}