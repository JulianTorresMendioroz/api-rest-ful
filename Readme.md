API Restfull - WEB 2

- En esta API se podra consultar un catalogo de productos, en el cual está dirigido a ecommerce de venta de indumentaria. 

- Miembro B: Torres Mendioroz Julian
- Miembro A: Barreyra Felipe

(COMO CONSUMIR/USAR LA API:)

- Productos:

- Todos los productos: GET -> http://localhost/web2/ecommerce_api/api/productos
(Si existen los productos, devuelve los mismos, y si no, un error con un mensaje que los productos no existen)

- Producto por ID: GET -> http://localhost/web2/ecommerce_api/api/productos/:id 
(Si existe el producto devuelve el mismo, y si no, un error con un mensaje que el id especificado no existe)

- Crear un nuevo producto: POST -> http://localhost/web2/ecommerce_api/api/productos
(Si se agergar el producto devuelve un mensaje de exito, y si no, un error con un mensaje que el producto no se pudo agregar)

Para poder agregar un producto: Debe de tener el siguiente patron: 

{
"img": "https://acdn.mitiendanube.com/stores/943/997/products/boy-beige1-2e3a2fe4fc6ce264d016676887628942-1024-1024.jpg", 
"name": "x",
"description": "x",
"price": 10000,
"fk_id_category": 1
}

("img": Imagen de prueba)

- IMPORTANTE:

FK_ID_CATEGORY: 

1 = Buzos
2 = Remeras
3 = Camperas

Se dividen en 3 categorias, en las cuales cada una tiene su temporada (Invierno, Verano y Otoño) 

- Actualizar un nuevo producto: PUT -> http://localhost/web2/ecommerce_api/api/:id
(Si se actualiza el producto devuelve un mensaje de exito, y si no, un error con un mensaje que el id especificado no se pudo actualizar)

Para poder actualizar un producto: Debe de tener el siguiente patron: 

Se le puede actualizar el nombre, descripcion y ID.

{
"name": "x",
"description": "x",
"price": 10000
}

("price": Precio de prueba)

- Eliminar un nuevo producto: DELETE -> http://localhost/web2/ecommerce_api/api/:id
(Si se elimina el producto devuelve un mensaje de exito, y si no, un error con un mensaje que el producto con id: "x" no se pudo se pudo eliminar)


