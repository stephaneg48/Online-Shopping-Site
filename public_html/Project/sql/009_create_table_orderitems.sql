CREATE TABLE IF NOT EXISTS `OrderItems`(
    `id` INT AUTO_INCREMENT PRIMARY  KEY
    ,`order_id` INT
    ,`product_id` INT
    ,`quantity` INT DEFAULT 0
    ,`unit_price` INT NOT NULL DEFAULT 0
    ,FOREIGN KEY (`order_id`) REFERENCES Orders(id)
    ,FOREIGN KEY (`product_id`) REFERENCES Cart(product_id)
    ,FOREIGN KEY (`quantity`) REFERENCES Cart(desired_quantity)
    ,FOREIGN KEY (`unit_price`) REFERENCES Cart(unit_price)
    ,UNIQUE KEY (`order_id`)
)