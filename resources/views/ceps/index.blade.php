@extends("includes.header")

@section("title", "ViaCep Infos")

@section("content")
<br>

<h2>Ceps Cadastrados</h2>

<br>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">CEP</th>
      <th scope="col">Logradouro</th>
      <th scope="col">Complemento</th>
      <th scope="col">Bairro</th>
      <th scope="col">Localidade</th>
      <th scope="col">UF</th>
      <th scope="col">IBGE</th>
      <th scope="col">Atualizado</th>
      <th scope="col">Atualizado em</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($ceps as $cep)
		<tr>
			<td>{{$cep->id}}</td>
			<td>{{cepMask($cep->cep)}}</td>
			<td>{{empty($cep->logradouro) ? "Não cadastrado" : $cep->logradouro}}</td>
			<td>{{empty($cep->complemento) ? "Não cadastrado" : $cep->complemento}}</td>
			<td>{{empty($cep->bairro) ? "Não cadastrado" : $cep->bairro}}</td>
			<td>{{empty($cep->localidade) ? "Não cadastrado" : $cep->localidade}}</td>
			<td>{{empty($cep->uf) ? "Não cadastrado" : $cep->uf}}</td>
			<td>{{empty($cep->ibge) ? "Não cadastrado" : $cep->ibge}}</td>
			<td>{{$cep->updated == "yes" ? "Sim" : "Não"}}</td>
			<td>{{$cep->updated_at}}</td>
		</tr>
    @endforeach
</table>

@endsection

@extends("includes.footer")