### Pizzahouse

Este proyecto constituye un pequeño sistema que venta de pizza, en la cual el usuario puede elegir entre distintos tipos de pizza, su tamaño, tipo de borde e ingredientes adicionales; mientas que el gestor del servicio puede gestionar estos elementos así como controlar como gestionar sus usuarios. El proyecto desarrolla una API Rest en el framework Laravel de PHP y permite desacoplar el cliente del mismo, de modo que se puedan desarrollar independientemente.

#### Elementos de arquitectura

Para diseñar el sistema de backend para venta de pizzas aspectos importantes como, y a grandes rasgos:

1. Diseño de la base de datos:

Crear las bases de datos necesarias para almacenar la información requerida: **Borde**, **Tamaño**, **Ingredientes**, **Pizzas**, **PizzasPrecio**, **Usuario**.

2. Diseño de la arquitectura:

- La plataforma emplea una arquitectura cliente-servidor mediante una API Rest, a través de la cual se gestiona y solicita información de los productos y la orden de pedido.
3. Implementación de la lógica de negocio:

- Desde una perspectiva de administrador del negocio: se permite gestionar y obtener información de los elementos que componen las pizzas como su tamaño, ingredientes, tipos, precios o tipos de borde; así como la gestión de los usuarios según sea o requiera el tipo de negocio.
- Por una perspectiva del usuario, este realiza una petición de una orden que a su vez puede ver con detalles y gestionarlo.
- La comunicación de datos se realiza mediante documentos JSON para enviar y recibir los datos.

### Diseño de la base de datos

La base de datos contendrá las tablas permitirán almacenar información sobre las pizzas disponibles, los ingredientes y bordes que se pueden agregar a cada pizza, y las relaciones entre pizzas, ingredientes y bordes. Sobre esta información se puede construir la lógica de negocio del sistema de venta de pizzas y tener una mayor organización y control sobre la información; así como facilidades de mantenimiento y extensibilidad de la base de datos.

#### Tabla *Usuario*

La tabla **Usuarios** almacena los datos básicos de cada usuario registrado y tiene como atributos:

- **id**: identificador único del usuario.

- **token**: identificador único del usuario.


| id  | token |
| --- | --- |
| 1   | 33fba080-77e2-47c6-a482-732f8b0117a1 |
| 2   | 6d1f6e8b-71a2-438c-a3d3-6ec8e6e9f1f6 |
| 3   | 6d1f6e8b-71a2-438c-a3d3-6ec8e6e9f1f6 |

#### Tabla *Pizzas*

La tabla **Pizzas** se utiliza para almacenar información sobre cada uno de los tipos de pizza que ofrece y tendrá los siguientes atributos:

- **id**: identificador único de la pizza.
- **name**: nombre de la pizza.
- **descripción**: descripción de la pizza.

| id  | name | description |
| --- | --- | --- |
|     |     |     |

#### Tabla *Tamaños*

La tabla **Tamaños** contiene información sobre los diferentes tamaños de pizza disponibles en el sistema, como su nombre, descripción y precio. La tabla tendrá los siguientes atributos:

- **id**: identificador único del tamaño de la pizza.

- **size**: tamaño del tipo de la pizza.


| id  | nombre |
| --- | --- |
|     |     |

#### Tabla *Pedidos*

La tabla **Pedidos** se utiliza para almacenar la información relativa a lo pedidos que se realicen, y tendrá los siguientes campos:

- **id**: identificador único del pedido.
- **user_id**: identificador único del usuarios.
- **pizza_id**: identificador único que referencia a la tabla de pizzas.
- **tamaño_id**: identificador único que referencia a la tabla de tamaños.
- **borde_id**: identificador único que referencia a la tabla de bordes.

| id  | usuario_id | pizza_id | tamaño_id | borde_id |
| --- | --- | --- | --- | --- |
|     |     |     |     |     |

#### Tabla *Pedido_Ingredientes*

La tabla **Pedido_Ingredientes** se utiliza para almacenar la información relativa a los ingredientes extras de los pedidos que se realicen y relaciona el identificador del pedido con el identificador de los ingredientes extras añadidos; y tendrá los siguientes campos:

- **id**: identificador único del pedido.
- **tamaño_id**: identificador único que referencia a la tabla de tamaño de las pizzas.
- **pizza_id**: identificador único que referencia a la tabla de las pizzas
- **precio**: precio correspondiente a una cierta pizza con determinado tamaño.

| id  | pizza_id | tamaño_id | precio |
| --- | --- | --- | --- |
|     |     |     |     |

#### Tabla *ingredientes*

La tabla **Ingredientes** almacena la información sobre cada ingrediente que se puede agrega a la pizza y tendrá los siguientes atributos:

- **id**: identificador único del ingrediente.
- **nombre**: nombre del ingrediente.
- **precio**: precio del ingrediente.

| id  | nombre | precio |
| --- | --- | --- |
|     |     |     |

#### Tabla *Pizza_Precio*

La tabla **Pizza_Precio** se utiliza para crear una relación entre las pizzas y los tamaños que la componen. Cada fila de esta tabla representa una relación entre una pizza y un tamaño. Se emplean los identificadores únicos de las pizzas (**id_pizza**) y de los ingredientes (**id_tamaño**) para almacenar esta información. Esta tabla tendrá, por tanto, los siguientes atributos:

- **id_pizza**: identificador único de la pizza.
- **id_tamaño**: identificador único del tamaño de la pizza.
- **precio**: precio de la pizza según su tamaño.

| id  | id_pizza | id_tamaño | precio |
| --- | --- | --- | --- |
|     |     |     |     |

#### Tabla *Bordes*

En la tabla **Bordes** almacenamos información sobre los distintos tipos de bordes que se ofrecen para las pizzas, y cada uno de ellos tiene un identificador único (**id**), un nombre y un precio. Los bordes pueden ser normales o rellenos, y cada uno tiene su propio precio tendrá los siguientes atributos:

- **id**: identificador único del borde.
- **rellenado**: valor booleando que valida si tiene o no algún relleno.
- **precio**: precio del borde.

| id  | relleno | precio |
| --- | --- | --- |
|     |     |     |

####

#### Relaciones

- Las tablas **Pizzas** y **Tamaños** tienen una relación **mucho-a-mucho** puesto que una pizza puede pedirse en varios tamaños así como cierto tamaño puede corresponder a varios tipos de pizza. Por ello se emplea la tabla **Pizza_Precio** que "hace de intermediario" al relacionarse de forma independiente.

- Similarmente, esto ocurre entre las tablas **Ingredientes** y **Pedido** puesto que un pedido puede tener asociado varios ingredientes extra así como un ingrediente extra pertenecer a varios pedidos; por lo que se emplea la tabla **Pedido_Ingrediente**.

- La tabla **Orden** tiene una relación **uno-a-uno** con las tablas **Borde**, **Tamaño**, **Pizza** y **Usuario**.


```
+---------+
|  Borde  |----------------------------------+
+---------+                                  |
                                             |
                                             |
+---------+                                  |
| Tamaño  |------------+---------------+     |
+---------+            |               |     |
                +------+-------+   +---+-----+---+        +--------------+
                | Pizza_Precio |   |    Oredn    |--+  +--| Ingredientes |
                +------+-------+   +---+-----+---+  |  |  +--------------+
+---------+            |               |     |      |  |
|  Pizza  |------------+---------------+     |   +--+--+-------------+
+---------+                                  |   | Orden_Ingrediente |
                                             |   +-------------------+
                                             |
+---------+                                  |
| Usuario |----------------------------------+
+---------+
```

#### API documentación

|     | GET (all) | GET (id) | POST | UPDATE | DELETE |
| --- | --- | --- | --- | --- | --- |
| **Edge** | **`/edges`** | **`/edge/:id`** | **`/edge`** | **`/edge/:id`** | **`/edge/:id`** |
| **Size** | **`/sizes`** | **`/size/:id`** | **`/ize`** | **`/size/:id`** | **`/size/:id`** |
| **Ingredients** | **`/ingredients`** | **`/ingredient/:id`** | **`/ingredient`** | **`/ingredient/:id`** | **`/ingredient/:id`** |
| **Pizza** | **`/pizzas`** | **`/pizza/:id`** | **`/pizza`** | **`/pizza/:id`** | **`/pizza/:id`** |
| **PizzaPrecio** | **`/pizzaprecios`** | **`/pizzaprecio/:id`** | **`/pizzaprecio`** | **`/pizzaprecio/:id`** | **`/pizzaprecio/:id`** |
| **User** | **`/users`** | **`/user/:id`** | **`/user`** | **`/user/:id`** | **`/user/:id`** |
| **Order** | **`/orders`** | **`/order/:id`** | **`/order`** | **`/order/:id`** | **`/order/:id`** |

#### Requests

| Edge | Size | Ingredients | Pizza | PizzaPrecio | User | Order |
| --- | --- | --- | --- | --- | --- | --- |
| **`{fill, price}`** | **`{size}`** | **`{name, price}`** | **`{name, descripcion}`** | **`{pizza_id, size_id, price}`** | **`{token}`** | **`{user_id, size_id, edge_id, pizza_id}`** |

### Ejecutar

Tener inicializado el serviciode la base de datos y haber configurado el proyectoo para la misma en el archoco `.env`


Ejecutar el servidor:
```php
php artisan serve
```
