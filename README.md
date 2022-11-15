# Endpoints

## (GET) /api/topAnotadores
###   Devuelve todos los jugadores
#
#
## (POST) /api/topAnotadores
###   Agrega un jugador pasandole un JSON en el body de la request
###   Ejemplo:
         { 
            "nombre": "Tomas Alvarez",
            "camiseta": 5,  
            "rol": "armador",  
            "equipo": 4,  
            "goles": 89  
         }
#
#
## (GET) /api/topAnotadores:ID
###   Devuelve la informacion del jugador con la id ingresada
#
#
## (DELETE) /api/topAnotadores:ID
###   Borra la informacion del jugador con la id ingresada
#
#
## (PUT) /api/topAnotadores:ID
###   Modifica los datos del jugador con la id ingresada, se debe pasar un JSON como body de la request
###   Ejemplo:
         { 
            "nombre": "Tomas Alvarez",
            "camiseta": 5,  
            "rol": "armador",  
            "equipo": 4,  
            "goles": 89  
         }
