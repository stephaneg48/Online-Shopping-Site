CREATE TABLE IF NOT EXISTS `Cart`(
    `id` INT AUTO_INCREMENT PRIMARY  KEY
    ,`name` VARCHAR(30) NOT NULL UNIQUE -- easier to deal with unique name instead of id
    ,`unit_price` INT DEFAULT 99999 -- shop prices: store as int... for displaying, divide by 100 (so 999.99 -> 99999 / 100)
    ,`product_id` INT
    ,`user_id` INT
    ,`desired_quantity` INT DEFAULT 0
    ,`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,`modified` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ,FOREIGN KEY (`product_id`) REFERENCES Products(id)
    ,FOREIGN KEY (`user_id`) REFERENCES Users(id)
)