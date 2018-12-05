# Gauler
Gauler es una api standar Rest

### Controladores RestFull

La existencia del modelo, requiere de un controlador propio que maneje 
su lógica de negocios es por esto que existen propiedades, que están 
sujetas a la forma como se accede a la api, y al endpoint que se realizá,
entre los metodos RestFull como Index, Show, Store, Update, Destroy.

### Fundamentary
nucleo RestFull

Fundamentary es el nucleo por el cual Gauler ejecutá el proceso RestFull, Fundamentary proporcioná
un completo y sincronizado sistema de busqueda del modelo asociado al endpoint, a su vez la ejecución de
un método middleware en conjunto al modelo, por encambio si resulta ser la necesidad del proceso de filtrado
para todos los métodos RestFull, Fundamentary ejecutá un closure.


``` php
RestFull::Model('users');
```

### Creando proyecto Gauler

```
composer create-project joalcapa/gauler
```
