<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cep extends Model
{
	const UPDATED_YES = "yes";
	const UPDATED_NO  = "no";

    protected $table = "ceps";

    protected $primaryKey = "id";

    protected $fillable = array(
    	"cep",
    	"logradouro",
    	"complemento",
    	"bairro",
    	"localidade",
    	"uf",
    	"unidade",
    	"ibge",
    	"gia",
    	"updated",
    );

    protected $dates = array(
    	"creation_at",
    	"updated_at",
    );

    public function syncViaCep($cep)
    {
    	$curl = curl_init();

    	curl_setopt_array($curl, array(
    		CURLOPT_URL => "https://viacep.com.br/ws/$cep/json/",
    		CURLOPT_RETURNTRANSFER => true,
    		CURLOPT_CUSTOMREQUEST => "GET",
    		CURLOPT_HTTPHEADER => array(
    			'Content-Type: application/json',
    		),
    	));

    	$response = curl_exec($curl);
    	$infoArray = json_decode($response, true);
    	$err = curl_error($curl);
    	curl_close($curl);

    	return $infoArray;
    }

    public function getNonUpdatedCeps()
    {
    	$result = Cep::select("cep")->where("updated", "no")->get();
    	
    	return $result;
    }
}
