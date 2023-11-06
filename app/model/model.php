<?php

    require_once 'config.php';
    
    class Model {
        protected $db;

        function __construct() {
            $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $this->deploy();
        }

        function deploy() {
            // Chequear si hay tablas
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            if(count($tables)==0) {
                // Si no hay crearlas
                $sql =<<<END
                --
                -- Base de datos: `db_ecommerce`
                --
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `category`
                --
                
                CREATE TABLE `category` (
                  `id` int(11) NOT NULL,
                  `name_category` varchar(100) NOT NULL,
                  `season` varchar(100) NOT NULL,
                  `description` varchar(250) NOT NULL,
                  `creation_date` date NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                
                --
                -- Volcado de datos para la tabla `category`
                --
                
                INSERT INTO `category` (`id`, `name_category`, `season`, `description`, `creation_date`) VALUES
                (1, 'Buzos', 'Invierno', '', '0000-00-00'),
                (2, 'Remeras', 'Verano', '', '0000-00-00'),
                (3, 'Camperas', 'Otoño', '', '0000-00-00');
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `client`
                --
                
                CREATE TABLE `client` (
                  `id` int(11) NOT NULL,
                  `username` varchar(250) NOT NULL,
                  `password` varchar(250) NOT NULL,
                  `rol` varchar(100) NOT NULL DEFAULT 'user'
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                
                --
                -- Volcado de datos para la tabla `client`
                --
                
                INSERT INTO `client` (`id`, `username`, `password`, `rol`) VALUES
                (1, 'daniel', '$2y$10$3vD1MXuFMH70znzv0j62F./jELxiey9vevpM1R23XDG5jLbuPL.fq', 'user'),
                (3, 'webadmin', '$2y$10$5vTCBDhKh91WK.Ws3oRdLe8//FxyvvfVCUcNT7uXThEC7CF.U2UCi', 'admin'),
                (7, 'pepe', '$2y$10$2irYy8pPw7TqPrHB.haaG.KvtK1Mxwp2DZ0uyyVejh01WocxrrIna', 'user'),
                (8, 'dario', '$2y$10$3u55z21.eI1wuK/zErbyKOhw33Ytyg1oUc/Kes2B9cltNKp8t5jkO', 'user');
                
                -- --------------------------------------------------------
                
                --
                -- Estructura de tabla para la tabla `products`
                --
                
                CREATE TABLE `products` (
                  `id` int(11) NOT NULL,
                  `img` varchar(250) NOT NULL,
                  `name` varchar(100) NOT NULL,
                  `description` varchar(100) NOT NULL,
                  `price` int(200) NOT NULL,
                  `offer` int(1) DEFAULT 0,
                  `fk_id_category` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                
                --
                -- Volcado de datos para la tabla `products`
                --
                
                INSERT INTO `products` (`id`, `img`, `name`, `description`, `price`, `offer`, `fk_id_category`) VALUES
                (1, 'https://http2.mlstatic.com/D_NQ_NP_781887-MLA69230254891_052023-O.webp', 'Buzo agregado de API', 'Buzo actualizado desde API', 14000, 1, 1),
                (20, 'https://acdn.mitiendanube.com/stores/943/997/products/boy-beige1-2e3a2fe4fc6ce264d016676887628942-1024-1024.jpg', 'Producto Actualizado desde api postman', 'me actualizaron', 14000, 1, 3),
                (24, 'https://acdn.mitiendanube.com/stores/943/997/products/boy-beige1-2e3a2fe4fc6ce264d016676887628942-1024-1024.jpg', 'Agregado desde postman', 'asd', 14000, 0, 2);
                
                --
                -- Índices para tablas volcadas
                --
                
                --
                -- Indices de la tabla `category`
                --
                ALTER TABLE `category`
                  ADD PRIMARY KEY (`id`);
                
                --
                -- Indices de la tabla `client`
                --
                ALTER TABLE `client`
                  ADD PRIMARY KEY (`id`);
                
                --
                -- Indices de la tabla `products`
                --
                ALTER TABLE `products`
                  ADD PRIMARY KEY (`id`),
                  ADD KEY `fk_category` (`fk_id_category`);
                
                --
                -- AUTO_INCREMENT de las tablas volcadas
                --
                
                --
                -- AUTO_INCREMENT de la tabla `category`
                --
                ALTER TABLE `category`
                  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
                
                --
                -- AUTO_INCREMENT de la tabla `client`
                --
                ALTER TABLE `client`
                  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
                
                --
                -- AUTO_INCREMENT de la tabla `products`
                --
                ALTER TABLE `products`
                  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
                
                --
                -- Restricciones para tablas volcadas
                --
                
                --
                -- Filtros para la tabla `products`
                --
                ALTER TABLE `products`
                  ADD CONSTRAINT `fk_category` FOREIGN KEY (`fk_id_category`) REFERENCES `category` (`id`);
                COMMIT;
                END;
                $this->db->query($sql);
            }
            
        }
    }
