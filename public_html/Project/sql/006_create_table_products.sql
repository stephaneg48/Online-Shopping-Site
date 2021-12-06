CREATE TABLE IF NOT EXISTS `Products`(
    `id` INT AUTO_INCREMENT PRIMARY  KEY
    ,`name` VARCHAR(30) NOT NULL UNIQUE -- easier to deal with unique name instead of id
    ,`description` TEXT NOT NULL
    ,`category` TEXT NOT NULL
    ,`stock` INT NOT NULL DEFAULT  0
    ,`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,`modified` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ,`unit_price` INT DEFAULT 99999 -- shop prices: store as int... for displaying, divide by 100 (so 999.99 -> 99999 / 100)
    ,`visibility` BOOLEAN DEFAULT 0
)