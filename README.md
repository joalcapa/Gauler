![image GIF Meuler](https://dl.dropboxusercontent.com/s/l63oki54lkx3ule/gauler%20logo.png?dl=0)

### Api  Rest RestFull

Gauler es una iniciativa de modelo orientado a las convenciones estándares de api Rest RestFull,
propuestas en el año 2000 por Roy Thomas Fielding, en el cual definen los procedimientos 
necesarios para la implementación de una Interfaz de programación para aplicaciones de alto nivel, persistencia de datos atravez del protocolo HTTP.

## Prioridad del Modelo

Al igual que los muchos frameworks, independientemente del lenguaje, el modelo
obtiene prioridad en patrones como MVC, MVVM, MVP, entre otros, 
ya que el modelo define claramente la lógica del negocio, y facilita en gran 
manera la implementación de diversos patrones como ActiveRecords, DAO, entre otros,
para el desarrollo de sistemas de mapeo de objetos relacionales, comunmente conocido
como ORMs.

## Controladores RestFull

La existencia del modelo en una api RestFull, requiere de un controlador propio que maneje 
su lógica de negocios de una forma fluida, es por esto que existen propiedades, que están 
sujetas a la forma como se accede a la api, y al endpoint que se realizá.

Entre los metodos RestFull, encontramos:

#### Index

Gauler implementa esté método, para el alcance de una colección de datos asignados al modelo.

#### Show

Gauler implementa esté método, para el alcance de un recurso asignados al modelo.

#### Store

Gauler implementa esté método, para persistir en la base de datos una nueva instacia del modelo.

#### Update

Gauler implementa esté método, para actualizar ciertas propiedades de una instancia del modelo.

#### Destroy

Gauler implementa esté método, para eliminar de forma permanente y en cascada una instancia del modelo.


## FUNDAMENTARY el nucleo RestFull
