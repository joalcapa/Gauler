
<div style="text-align:center" markdown="1">

![image GIF Meuler](https://dl.dropboxusercontent.com/s/l63oki54lkx3ule/gauler%20logo.png?dl=0)

</div>



## Controladores RestFull

La existencia del modelo, requiere de un controlador propio que maneje 
su lógica de negocios es por esto que existen propiedades, que están 
sujetas a la forma como se accede a la api, y al endpoint que se realizá, entre los metodos RestFull como Index, Show, Store, Update, Destory.

## FUNDAMENTARY
nucleo RestFull

Fundamentary es el nucleo por el cual Gauler ejecutá el proceso RestFull, Fundamentary proporcioná
un completo y sincronizado sistema de busqueda del modelo asociado al endpoint, a su vez la ejecución de
un método middleware en conjunto al modelo, por encambio si resulta ser la necesidad del proceso de filtrado
para todos los métodos RestFull, Fundamentary ejecutá un closure.


``` php
/**
 * Definición del modelo, Gauler intentará ejecutar previamente una clase
 * middleware RestFull en caso de existir, posteriormente al filtrado realizará la ejecución del controlador,
 * aquél modelo que no se establezca en este archivo, emitirá un error 404 RESOURCE NOT FOUND.
 *
 * El modelo 'users' es totalmente obligatorio para el funcionamiento 
 * del servicio de autenticación
 */
RestFull::Model('users');
/**
 * Si por el contrario considera que no es necesario la ejecución
 * de una clase middleware RestFull, con todos los métodos RestFull
 * correspondientes, puede optar por la ejecución de un closure,
 * recordando retornar siempre $request, si el filtro es exitoso,
 * de lo contrario puede utilizar el mágic killer, para abortar la operación
 * con un código http que ud considere.
 */
/*
RestFull::Model('users', function($request) {
    // killer('401');
    return $request;
});
*/
```
