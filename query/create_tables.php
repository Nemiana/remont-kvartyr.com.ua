<!-- Creation all tables DB and admin account (just one time!) -->
<?php
    //Connect to DB and return link
    if ($link = require ('/query/connect.php')) {
        //Table for data of users
        $sql = "CREATE TABLE IF NOT EXISTS `authentication` (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name_user VARCHAR(255),
                    password_user VARCHAR(255),
                    access_rights VARCHAR(50)
                )";
        $result = mysqli_query ($link, $sql);
        if ($result == false) echo 'Table authentication: ' . mysqli_error ($link);
        //Table for meta-tags for all pages
        $sql = "CREATE TABLE IF NOT EXISTS meta (
                id INT AUTO_INCREMENT PRIMARY KEY,
                page_url VARCHAR(255),
                meta_title VARCHAR(255),
                meta_keywords VARCHAR(255),
                meta_description VARCHAR(255)
            )";
        $result = mysqli_query ($link, $sql);
        if ($result == false) echo 'Table meta: ' . mysqli_error ($link);
        //Table for description of home page
        $sql = "CREATE TABLE IF NOT EXISTS home_page (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    title VARCHAR(255),
                    article TEXT
                )";
        $result = mysqli_query ($link, $sql);
        if ($result == false) echo 'Table home_page: ' . mysqli_error ($link);
        //Table for info of services and prices
        $sql = "CREATE TABLE IF NOT EXISTS price_page (
            id INT AUTO_INCREMENT PRIMARY KEY,
            `service` TEXT,
            price FLOAT
        )";
        $result = mysqli_query ($link, $sql);
        if ($result == false) echo 'Table price_page: ' . mysqli_error ($link);
        //Parent table for gallery objects
        $sql = "CREATE TABLE IF NOT EXISTS gallery_page (
            id INT AUTO_INCREMENT PRIMARY KEY,
            object_name VARCHAR(255),
            object_start_image VARCHAR(255)
        )";
        $result = mysqli_query ($link, $sql);
        if ($result == false) echo 'Table gallery_page: ' . mysqli_error ($link);
        //Child table for each object with images and descriptions
        $sql = "CREATE TABLE IF NOT EXISTS gallery_objects (
            id INT AUTO_INCREMENT PRIMARY KEY,
            object_id INT,
            object_image VARCHAR(255),
            image_description TEXT,
            FOREIGN KEY (object_id) REFERENCES gallery_page(id) ON DELETE CASCADE
        )";
        $result = mysqli_query ($link, $sql);
        if ($result == false) echo 'Table gallery_objects: ' . mysqli_error ($link);
        //Table for articles
        $sql = "CREATE TABLE IF NOT EXISTS article_page (
            id INT AUTO_INCREMENT PRIMARY KEY,
            meta_title VARCHAR(255),
            meta_keywords VARCHAR(255),
            meta_description VARCHAR(255),
            title_article VARCHAR(255),
            `url` VARCHAR(255),
            text_article TEXT,
            date_publication_article DATETIME,
            image_article VARCHAR(255)
        )";
        $result = mysqli_query ($link, $sql);
        if ($result == false) echo 'Table article_page: ' . mysqli_error ($link);
        //Table for reviews
        $sql = "CREATE TABLE IF NOT EXISTS review_page (
            id INT AUTO_INCREMENT PRIMARY KEY,
            text_review TEXT,
            name_user VARCHAR(255),
            date_publication_review DATETIME,
            check_publication TINYINT(1)
        )";
        $result = mysqli_query ($link, $sql);
        if ($result == false) echo 'Table review_page: ' . mysqli_error ($link);
        //Table for contact info
        $sql = "CREATE TABLE IF NOT EXISTS contact_page (
            id INT AUTO_INCREMENT PRIMARY KEY,
            info_contact TEXT
        )";
        $result = mysqli_query ($link, $sql);
        if ($result == false) echo 'Table contact_page: ' . mysqli_error ($link);
        
        //Creation admin account
        $sql = "INSERT INTO `authentication` SET name_user = ?, password_user = ?, access_rights = ?";
        //Prepare query
        $stmt = mysqli_prepare($link, $sql);
        //Bind parameters to query
        mysqli_stmt_bind_param($stmt, 'sss', $name, $pass, $rights);
        //Setting user-name and hash password
        $name = 'user';
        $pass = password_hash('123', PASSWORD_DEFAULT);
        $rights = 'admin';
        mysqli_stmt_execute($stmt);
        //Close statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }