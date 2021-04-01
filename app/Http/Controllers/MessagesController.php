<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    /**
     * Muestra la lista de mensajes de dichos chats con toda la info.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = DB::table('chats')
        ->join('messages', 'chats.id', '=', 'messages.id_chat')
        ->select('chats.*', 'messages.mensaje', 'messages.sentido', 'messages.id_user', 'messages.id as id_messages')
        ->get();

        return $messages;

        // return view('messages.index', compact('messages'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Lee los mensajes de un chat especifico.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */

    public function messagesChat($id){

        $user_message = DB::table('chats')
        ->where('chats.id', '=', $id)
        ->join('messages', 'chats.id', '=', 'messages.id_chat')
        ->select('chats.*', 'messages.mensaje', 'messages.sentido', 'messages.id_user')
        ->get();
        

        return $user_message;
        // return view('messages.chat', compact('user_message'));
    }

    /**
     * Agrega el json de mensajes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function addMesagges(Request $request){
        $contacto = $request->contacto;
        $mensajes =  $request->mensajes;
        
        for($i = 0; $i < count($mensajes); $i++){
            $array= json_decode(json_encode($mensajes[$i]), false);
            $chat = DB::table('chats')
                ->select('id')
                ->where('id_user1', '=', $array->id_user1)
                ->where('id_user2', '=', $array->id_user2)
                ->orWhere('id_user1', '=', $array->id_user2)
                ->where('id_user2', '=', $array->id_user1)
                ->first();
            
            if($chat){
                $messages = DB::table('messages')->insert([
                    'id_user' => $array->id_user,
                    'sentido' => $array->sentido,
                    'mensaje' => $array->mensaje,
                    'contacto' => $contacto,
                    'id_chat' => $chat->id
                ]);
                if(!$messages){
                    return response()->json([
                        'status' => 'Fallado',
                    ]);
                }
            }else{
                $chatCreado = DB::table('chats')->insert([
                    'id_user1' => $array->id_user1,
                    'id_user2' => $array->id_user2
                ]);
                if($chatCreado){
                    $chat = DB::table('chats')
                        ->select('id')
                        ->where('id_user1', '=', $array->id_user1)
                        ->where('id_user2', '=', $array->id_user2)
                        ->orWhere('id_user1', '=', $array->id_user2)
                        ->where('id_user2', '=', $array->id_user1)
                        ->first();
                    if($chat){
                        $messages = DB::table('messages')->insert([
                            'id_user' => $array->id_user,
                            'sentido' => $array->sentido,
                            'mensaje' => $array->mensaje,
                            'contacto' => $contacto,
                            'id_chat' => $chat->id
                        ]);
                        if(!$messages){
                            return response()->json([
                                'status' => 'Fallado',
                            ]);
                        }
                    }else{
                        return response()->json([
                            'status' => 'Fallado',
                        ]);
                    }
                }
            }
            
        }
        
        return response()->json([
            'status' => 'Realizado',
        ]); 
    }
}
