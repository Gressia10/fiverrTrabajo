Asumiendo que ya tiene todo el entorno de php instalado, composer y wampserver 
1)Crear el archivo ".env" guiandose del ".env.example" y cambiar (DB_DATABASE=laravel) poniendo el nombre de tu bd
2)composer install
3)php artisan migrate
4)php artisan key:generate
5)php run server

las url para las peticiones son:
GET http://127.0.0.1:8000/messages (para ver todos los mensajes de todos los chats) retorna un array de json
GET http://127.0.0.1:8000/messages/id ejm http://127.0.0.1:8000/messages/1 (para ver los mensajes del chat en espesifico, debe sustiruir id por el el id del chat) retorna un array de json
POST http://127.0.0.1:8000/api/messages para crear nuevos mensajes debe agregar en el Header Key=Content-Type y Value=application/json enviar en el body un json como el siguiente:
{
	"contacto":"aaaaa",
    "mensajes":[
    {"mensaje":"aaaa",
    "sentido":"saliente",
    "id_user":3,
    "id_user1":3,
    "id_user2":4},
    {"mensaje":"bbbbb",
    "id_user":4,
    "sentido":"entrante",
    "id_user1":4,
    "id_user2":5}
    ]
} 
retorna un mensaje que dice si fue realizado o fallido