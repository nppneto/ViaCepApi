<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cep;

class ViaCepRobot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cep-robot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Robô que preenche tabela com informações a partir de um CEP através da API ViaCep';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cepClass = new Cep();

        $ceps = $cepClass->getNonUpdatedCeps();

        foreach ($ceps as $cep) {
            $info = $cepClass->syncViaCep($cep->cep);
            $clean_cep = preg_replace("/(\D)/", "", $info["cep"]);

            $results = Cep::select("*")->where("cep", $clean_cep)->get();

            $updated_info = array(
                "logradouro" => $info["logradouro"],
                "complemento" => $info["complemento"],
                "bairro" => $info["bairro"],
                "localidade" => $info["localidade"],
                "uf" => $info["uf"],
                "unidade" => $info["unidade"],
                "ibge" => $info["ibge"],
                "gia" => $info["gia"],
                "updated" => Cep::UPDATED_YES,
            );

            foreach ($results as $result) {
                if (is_null($result->id)) {
                    return $this->info(sprintf("CEP nº %s não cadastrado na base de dados local.", $info["cep"]));
                }

                if (!Cep::whereId($result->id)->update($updated_info)) {
                    return $this->info(sprintf("Erro ao atualizar o CEP nº %s", $info["cep"]));
                }

                return $this->info(sprintf("CEP nº %s atualizado com sucesso!", $info["cep"]));
            }
        }
    }
}
