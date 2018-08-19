<?php

namespace App\Http\Controllers;

use App\Pedido;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class PedidoController extends Controller
{
    //
    public function montarPedido(Request $request)
    {
        $token = $request->header('token');

        try{
            $decoded = JWT::decode($token, getenv("APP_TOKEN_KEY"), array('HS256'));
        }
        catch (Exception $e)
        {
            return JsonResponse::fromJsonString(['error' => 'Token Inválido'],404);
        }

        if(!empty($decoded->pedido))
        {
            $pedido = Pedido::find(base64_decode($decoded->pedido));
            if(empty($pedido))
            {
                return JsonResponse::fromJsonString(['error' => 'Token inválido'],404);

            }

            $pizza = $pedido->pizza;
            $toppings = $pizza->toppings;

            $response = array();


            $response['codigo_pedido'] = $pedido->id;
            $response['pizza'] = array(['tamanho' => $pizza->tamanho->nome_tam, 'valor' => $this->formata_moeda($pizza->tamanho->valor_tam)],
                                       ['sabor' => $pizza->sabor->nome_sab, 'valor' => $this->formata_moeda($pizza->sabor->valor_sab)]);


            $response['topping'] = array();

            $response['valor_total'] = 0;
            $response['tempo_total'] = 0;
            $response['tempo_total'] += $pizza->tamanho->tempo_tam;
            $response['tempo_total'] += $pizza->sabor->tempo_sab;
            $response['valor_total'] += $pizza->tamanho->valor_tam;
            $response['valor_total'] += $pizza->sabor->valor_sab;

            foreach ($toppings as $key => $cada):
                $response['topping'][] = ['tipo' => $cada->nome_top, 'valor' => $this->formata_moeda($cada->valor_top)];

                $response['tempo_total'] += $cada->tempo_top;
                $response['valor_total'] += $cada->valor_top;

            endforeach;

            $response['valor_total'] = $this->formata_moeda($response['valor_total']);

            return JsonResponse::fromJsonString($response,200);
        }

        return JsonResponse::fromJsonString([],404);
    }

    private function formata_moeda($valor)
    {
        return number_format($valor,2,',','.');
    }

}
