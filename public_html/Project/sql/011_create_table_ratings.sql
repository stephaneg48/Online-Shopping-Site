CREATE TABLE IF NOT EXISTS `Ratings`(
    `id` INT AUTO_INCREMENT PRIMARY  KEY
    ,`product_id` INT
    ,`user_id` INT
    ,`rating` INT
    ,`comment` TEXT
    ,`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,FOREIGN KEY (`user_id`) REFERENCES Users(id)
    ,FOREIGN KEY (`product_id`) REFERENCES Products(id)
)