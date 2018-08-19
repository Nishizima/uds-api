<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Pizza;
use App\Sabor;
use App\Tamanho;

use Firebase\JWT\JWT;


class PizzaController extends Controller
{
    //
    public function montaPizza(Request $request)
    {
        $params = $request->all();

        if(!empty($params['tamanho']))
        {
            if(is_numeric($params['tamanho']))
            {
                $tamanho = Tamanho::find($params['tamanho']);
            }
            else
            {
                $tamanho = Tamanho::where(['nome_tam' => mb_strtolower($params['tamanho'])])->first();
            }

            if(empty($tamanho))
            {
                return JsonResponse::fromJsonString(['error' => 'Tamanho não encontrado'],404);
            }
        }
        else
        {
            return JsonResponse::fromJsonString(['error' => 'O tamanho é obrigatório e deve ser informado'],422);
        }

        if(!empty($params['sabor']))
        {
            if(is_numeric($params['sabor']))
            {
                $sabor = Sabor::find($params['sabor']);
            }
            else
            {
                $sabor = Sabor::where(['nome_sab' => mb_strtolower($params['sabor'])])->first();
            }

            if(empty($sabor))
            {
                return JsonResponse::fromJsonString(['error' => 'Sabor não encontrado'],404);
            }
        }
        else
        {
            return JsonResponse::fromJsonString(['error' => 'O Sabor é obrigatório e deve ser informado'],422);
        }

        $pizza = factory(Pizza::class)->create(['tamanho_id'=>$tamanho->id,'sabor_id' =>$sabor->id]);

        $pedido = factory(Pedido::class)->create(['pizza_id' => $pizza->id]);


        $token = array(
            'pedido' => base64_encode($pedido->id),
            'pizza' => base64_encode($pizza->id),
            'data' => $pedido->created_at
        );

        $jwt = JWT::encode($token, env("APP_TOKEN_KEY",'nishizima@2018'));




        return JsonResponse::fromJsonString(['token' => $jwt],201);
    }


}
