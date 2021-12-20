CREATE TABLE IF NOT EXISTS `Orders`(
    `id` INT AUTO_INCREMENT PRIMARY  KEY
    ,`user_id` INT
    ,`total_price` INT NOT NULL DEFAULT 0
    ,`address` TEXT NOT NULL
    ,`payment_method` TEXT NOT NULL
    ,`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,FOREIGN KEY (`user_id`) REFERENCES Users(id)
    ,UNIQUE KEY (`user_id`)
)