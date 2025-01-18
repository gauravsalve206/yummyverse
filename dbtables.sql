
-- Create Categories Table
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Create Areas Table
CREATE TABLE areas (
    area_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Create Recipes Table
CREATE TABLE recipes (
    recipe_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    instructions TEXT NOT NULL,
    image_url TEXT,
    video_url TEXT,
    source_url TEXT,
    category_id INT,
    area_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (area_id) REFERENCES areas(area_id)
);

-- Create Ingredients Table
CREATE TABLE ingredients (
    ingredient_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Create Recipe_Ingredients Table
CREATE TABLE recipe_ingredients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT NOT NULL,
    ingredient_id INT NOT NULL,
    measure VARCHAR(255),
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id),
    FOREIGN KEY (ingredient_id) REFERENCES ingredients(ingredient_id)
);
