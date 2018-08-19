<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Topping;
use App\Pizza;
use Firebase\JWT\JWT;


class ToppingController extends Controller
{
    public function personalizaPizza(Request $request)
    {
        $token = $request->header('token');
        $params = $request->all();

        try{
            $decoded = JWT::decode($token, getenv("APP_TOKEN_KEY"), array('HS256'));
        }
        catch (Exception $e)
        {
            return JsonResponse::fromJsonString(['error' => 'Token Inválido'],404);
        }

        if(!empty($decoded->pedido))
        {
            if(!empty($params['topping']))
            {
                $toppings = array();
                foreach ($params['topping'] as $key => $cada):

                    if(is_numeric($cada))
                    {
                        $topping = Topping::find($cada);
                    }
                    else
                    {
                        $topping = Topping::where('nome_top', mb_strtolower($cada))->first();
                    }
                    if(empty($topping))
                    {
                        return JsonResponse::fromJsonString(['error' => "Topping ['".$cada."'] não encontrado"],404);
                    }

                    $toppings[] = $topping->id;
                endforeach;



            }

            if(!empty($topping))
            {
                $pizza = Pizza::find(base64_decode($decoded->pizza));
                if(empty($pizza))
                {
                    return JsonResponse::fromJsonString(['error' => 'Token inválido'],404);
                }

                $pizza->toppings()->detach();
                $pizza->toppings()->attach($toppings);

            }

            return JsonResponse::fromJsonString(['token' => $token],200);

        }

        return JsonResponse::fromJsonString([],404);
    }
}
