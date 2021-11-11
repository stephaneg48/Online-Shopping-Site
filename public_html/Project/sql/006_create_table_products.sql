CREATE TABLE IF NOT EXISTS Products(
    `id` int AUTO_INCREMENT PRIMARY  KEY,
    `name` varchar(30) UNIQUE -- easier to deal with unique name instead of id
    `description` text,
    `category` text,
    `stock` int DEFAULT  0,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
    `unit_price` int DEFAULT 99999, -- shop prices: store as int... for displaying, divide by 100 (so 999.99 -> 99999 / 100)
    `visibility` BOOLEAN DEFAULT 0,
    `image` text, -- this col type can't have a default value
)