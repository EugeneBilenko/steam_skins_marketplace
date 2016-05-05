<?php

namespace App\Http\Controllers\Blockchain;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlockchainController extends Controller
{
    public function testBlockchaineCurlLocal(){

        $api_code = '17074ee3-ff36-47a4-bf8c-f8d64ac53b92';
        $Blockchain = new \Blockchain\Blockchain($api_code);
//        $Blockchain->setServiceUrl('http://localhost:3000/');
        $Blockchain->setServiceUrl('http://localhost:3000/api/v2/create');
//        $Blockchain->setServiceUrl('https://api.blockchain.info/');
        $wallet_guid = "fd3acf22-9d7c-4062-a15b-64488db6a4e0";
        $wallet_pass = "vjqgfhjkm13";
        $Blockchain->Wallet->credentials($wallet_guid, $wallet_pass);
        $balance = $Blockchain->Wallet->getBalance();

        dd($balance);
        //todo get second api key from https://blockchain.info

    }

    public function wallet() {

    }

    public function testBlockchaineCurl(){

        $curl = curl_init();
        $mainUrl = "https://api.blockchain.info/";
        $encode = urlencode('http://skinventory.com/');
        $xpub = "xpub6D64DvhjG1fjEkDi1ZF4eEua59bfn41GX5f49ZNMuLv2PFtERAysUvRbAPT5VFCwMCwvgYGeuXdW7xsEUDnf65zUziRmCQGKMDTYJvtsUQ4";
        $apiKey = '17074ee3-ff36-47a4-bf8c-f8d64ac53b92&callback';
        curl_setopt_array($curl, array(
//            CURLOPT_URL => "https://api.blockchain.info/v2/receive?xpub=xpub6D64DvhjG1fjEkDi1ZF4eEua59bfn41GX5f49ZNMuLv2PFtERAysUvRbAPT5VFCwMCwvgYGeuXdW7xsEUDnf65zUziRmCQGKMDTYJvtsUQ4&key=17074ee3-ff36-47a4-bf8c-f8d64ac53b92&callback=http%253A%252F%252Fskinventory.com%253F",
            CURLOPT_URL => $mainUrl . "v2/receive?xpub=". $xpub ."&key=". $apiKey ."=" . $encode,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}
