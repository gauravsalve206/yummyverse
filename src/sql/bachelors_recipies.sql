-- Insert categories
INSERT INTO categories (name) VALUES 
('Breakfast'), 
('Lunch'), 
('Dinner'), 
('Snack'), 
('Dessert'),
('Beverages');

-- Insert areas
INSERT INTO areas (name) VALUES 
('North Indian'), 
('South Indian'), 
('East Indian'), 
('West Indian');

-- Recipies
INSERT INTO recipes (name, category_id, area_id, instructions, image_url, video_url) VALUES 
-- Breakfast Recipes
('Poha', 1, 4, 'Wash poha thoroughly to remove excess starch and soak lightly. Heat oil in a pan, add mustard seeds, curry leaves, and chopped green chilies. Sauté onions until translucent and mix in the poha. Season with salt, turmeric, and sugar, and mix well. Garnish with fresh coriander and serve with lemon wedges.', 
'https://example.com/images/poha.jpg', 'https://youtu.be/examplepoha'), 

('Upma', 1, 4, 'Dry roast semolina in a pan until slightly golden and aromatic, then set aside. Heat oil, temper with mustard seeds, curry leaves, and green chilies. Add finely chopped vegetables and sauté until tender. Stir in roasted semolina and gradually add hot water while mixing to avoid lumps. Cook until the mixture thickens and serve hot.', 
'https://example.com/images/upma.jpg', 'https://youtu.be/exampleupma'),

('Masala Dosa', 1, 2, 'Prepare dosa batter by fermenting a mixture of rice and urad dal overnight. Heat a dosa pan, pour a ladleful of batter, and spread it thin. Add spiced potato filling in the center and fold the dosa. Serve hot with coconut chutney and sambhar.', 
'https://example.com/images/masaladosa.jpg', 'https://youtu.be/examplemasaladosa'), 

('Aloo Paratha', 1, 1, 'Prepare dough by mixing whole wheat flour with water and kneading to a soft consistency. Stuff the dough with a mixture of spiced mashed potatoes, roll out into flat discs, and cook on a hot tawa. Brush with ghee and serve with curd or pickle.', 
'https://example.com/images/alooparatha.jpg', 'https://youtu.be/examplealooparatha'), 

('Vegetable Sandwich', 1, 1, 'Spread butter or chutney on slices of bread. Layer with thinly sliced vegetables like cucumber, tomato, and onion. Add a sprinkle of salt and pepper. Close the sandwich and toast it in a sandwich maker or grill. Serve with ketchup or green chutney.', 
'https://example.com/images/vegetablesandwich.jpg', 'https://youtu.be/examplevegetablesandwich'), 

-- Lunch Recipes
('Rajma Chawal', 2, 1, 'Soak rajma (kidney beans) overnight and cook until soft. Sauté onions, ginger, and garlic in oil, add tomato puree and cook with spices. Mix in cooked rajma and simmer for a few minutes. Serve hot over steamed rice.', 
'https://example.com/images/rajmachawal.jpg', 'https://youtu.be/examplerajmachawal'), 

('Chole Bhature', 2, 1, 'Prepare chole by cooking chickpeas in a spicy onion-tomato gravy. For bhature, make a soft dough using flour, yogurt, and a pinch of baking soda. Roll out and deep-fry until fluffy. Serve together with sliced onions and pickles.', 
'https://example.com/images/cholebhature.jpg', 'https://youtu.be/examplecholebhature'), 

('Vegetable Pulao', 2, 1, 'Wash and soak rice. Heat oil or ghee in a pan, sauté whole spices, onions, and mixed vegetables. Add rice and water in the right proportion. Cover and cook on low heat until rice is fluffy and the vegetables are tender.', 
'https://example.com/images/vegetablepulao.jpg', 'https://youtu.be/examplevegetablepulao'), 

('Palak Paneer', 2, 1, 'Blanch spinach and blend into a puree. Sauté onions, garlic, and spices in oil, add tomato puree, and cook well. Mix in the spinach puree and paneer cubes. Simmer for a few minutes and serve hot with roti or naan.', 
'https://example.com/images/palakpaneer.jpg', 'https://youtu.be/examplepalakpaneer'), 

('Egg Curry', 2, 1, 'Boil eggs and peel them. Prepare a gravy with sautéed onions, garlic, tomatoes, and spices. Add boiled eggs to the gravy and simmer for a few minutes to allow the flavors to infuse. Serve with rice or paratha.', 
'https://example.com/images/eggcurrry.jpg', 'https://youtu.be/exampleeggcurrry'),

-- Dinner Recipes
('Paneer Butter Masala', 3, 1, 'Prepare a tomato-based gravy with spices and butter. Blend it smooth and add cream for richness. Add paneer cubes and simmer on low heat. Serve with naan or rice.', 
'https://example.com/images/paneerbuttermasala.jpg', 'https://youtu.be/examplepaneerbuttermasala'), 

('Dal Tadka', 3, 1, 'Cook lentils (dal) until soft. Heat ghee, add garlic, onions, and spices for tempering. Pour the tempering over the cooked dal, mix well, and serve hot with steamed rice.', 
'https://example.com/images/daltadka.jpg', 'https://youtu.be/exampledaltadka'), 

('Aloo Gobi', 3, 1, 'Sauté potatoes and cauliflower florets with cumin, onions, tomatoes, and spices in oil. Cover and cook until the vegetables are tender. Garnish with fresh coriander and serve.', 
'https://example.com/images/aloogobi.jpg', 'https://youtu.be/examplealoogobi'), 

('Bhindi Masala', 3, 1, 'Sauté okra (bhindi) in oil until lightly crisp. Set aside. Prepare a spiced onion-tomato gravy, mix in the sautéed bhindi, and cook briefly. Serve as a side dish.', 
'https://example.com/images/bhindimasala.jpg', 'https://youtu.be/examplebhindimasala'), 

('Vegetable Khichdi', 3, 1, 'Wash rice and lentils. Cook with mixed vegetables, ginger, turmeric, and whole spices. Add water and pressure cook until soft. Serve with ghee and pickle.', 
'https://example.com/images/vegetablekhichdi.jpg', 'https://youtu.be/examplevegetablekhichdi'),

-- Snacks
('Bhel Puri', 4, 4, 'Mix puffed rice, finely chopped onions, tomatoes, and boiled potatoes in a bowl. Add tamarind chutney, green chutney, and spices. Garnish with sev and coriander before serving.', 
'https://example.com/images/bhelpuri.jpg', 'https://youtu.be/examplebhelpuri'),

-- Snacks
('Samosa', 4, 1, 'Prepare dough using flour, oil, and water. Cook a spiced filling with boiled potatoes, peas, and spices. Roll out small portions of dough into discs, cut in half, and form a cone. Stuff the cone with filling and seal the edges. Deep-fry until golden and crispy. Serve hot with chutney.', 
'https://example.com/images/samosa.jpg', 'https://youtu.be/examplesamosa'), 

('Pakora', 4, 1, 'Prepare a batter with gram flour, water, spices, and a pinch of baking soda. Dip slices of vegetables like onions, potatoes, or spinach into the batter and deep-fry until golden brown. Serve hot with mint chutney or ketchup.', 
'https://example.com/images/pakora.jpg', 'https://youtu.be/examplepakora'), 

('Dhokla', 4, 4, 'Mix gram flour, water, ginger, green chili paste, and a pinch of baking soda into a smooth batter. Steam the batter in a greased tray until cooked through. Temper with mustard seeds, curry leaves, and green chilies. Serve with green chutney.', 
'https://example.com/images/dhokla.jpg', 'https://youtu.be/exampledhokla'), 

('Pani Puri', 4, 4, 'Prepare small puris by frying dough discs until crispy. Make a spiced tamarind water and a stuffing with mashed potatoes, chickpeas, and spices. Assemble by cracking the puris, filling them with stuffing, and adding flavored water. Serve immediately.', 
'https://example.com/images/panipuri.jpg', 'https://youtu.be/examplepanipuri'), 

('Kachori', 4, 1, 'Prepare dough with flour, oil, and water. Make a spiced filling using lentils or potatoes. Roll out small discs, add the filling, and seal the edges. Deep-fry the kachoris until golden and crispy. Serve with tamarind chutney.', 
'https://example.com/images/kachori.jpg', 'https://youtu.be/examplekachori'), 

-- Dessert Recipes
('Gulab Jamun', 5, 1, 'Prepare dough using khoya, flour, and milk. Shape into small balls and deep-fry on low heat until golden brown. Soak the fried balls in sugar syrup flavored with cardamom and rose water. Serve warm or chilled.', 
'https://example.com/images/gulabjamun.jpg', 'https://youtu.be/examplegulabjamun'), 

('Rasgulla', 5, 4, 'Make small balls of chenna (curdled milk) and cook in boiling sugar syrup until they double in size. Let them cool in the syrup and serve chilled.', 
'https://example.com/images/rasgulla.jpg', 'https://youtu.be/examplerasgulla'), 

('Kheer', 5, 1, 'Cook rice in milk until tender. Add sugar, cardamom, and nuts, and simmer until the mixture thickens. Serve warm or chilled as a sweet dessert.', 
'https://example.com/images/kheer.jpg', 'https://youtu.be/examplekheer'), 

('Jalebi', 5, 1, 'Prepare a batter with flour, yogurt, and water, and let it ferment for a few hours. Pipe the batter into hot oil in spiral shapes and fry until crispy. Soak the jalebis in sugar syrup and serve hot.', 
'https://example.com/images/jalebi.jpg', 'https://youtu.be/examplejalebi'), 

('Ladoo', 5, 1, 'Roast gram flour in ghee until aromatic. Mix in powdered sugar, cardamom, and nuts. Shape the mixture into small balls while warm. Let them cool and set before serving.', 
'https://example.com/images/ladoo.jpg', 'https://youtu.be/exampleladoo'), 

-- Beverages
('Masala Chai', 6, 1, 'Boil water with tea leaves, crushed ginger, cardamom, and spices. Add milk and sugar to taste. Simmer for a few minutes and strain into cups. Serve hot.', 
'https://example.com/images/masalachai.jpg', 'https://youtu.be/examplemasalachai'), 

('Lassi', 6, 1, 'Blend yogurt, sugar, and a splash of water until smooth. Add cardamom powder or rose water for flavor. Serve chilled, garnished with chopped nuts.', 
'https://example.com/images/lassi.jpg', 'https://youtu.be/examplelassi'), 

('Filter Coffee', 6, 2, 'Prepare strong coffee decoction using a South Indian coffee filter. Heat milk and sugar in a cup, add the decoction, and froth the coffee by pouring back and forth between two vessels. Serve hot.', 
'https://example.com/images/filtercoffee.jpg', 'https://youtu.be/examplefiltercoffee'), 

('Coconut Water', 6, 4, 'Simply serve fresh coconut water chilled or with ice cubes for a refreshing drink.', 
'https://example.com/images/coconutwater.jpg', 'https://youtu.be/examplecoconutwater'), 

('Aam Panna', 6, 1, 'Boil raw mangoes, peel and mash the pulp. Blend with sugar, roasted cumin powder, black salt, and mint leaves. Dilute with water and serve chilled.', 
'https://example.com/images/aampanna.jpg', 'https://youtu.be/exampleaampanna'); 

-- Ingredients
-- Ingredients Table Insertions
INSERT INTO ingredients (ingredient_id,name) VALUES  
(1, 'Flattened Rice'),
(2, 'Onion'),
(3, 'Mustard Seeds'),
(4, 'Green Chilies'),
(5, 'Turmeric Powder'),
(6, 'Curry Leaves'),
(7, 'Lemon Juice'),
(8, 'Coriander'),
(9, 'Salt'),
(10, 'Semolina'),
(11, 'Mixed Vegetables'),
(12, 'Dosa Batter'),
(13, 'Potatoes'),
(14, 'Ghee'),
(15, 'Water'),
(16, 'Wheat Flour'),
(17, 'Rice'),
(18, 'Urad Dal'),
(19, 'Fenugreek Seeds'),
(20, 'Sugar'),
(21, 'Milk'),
(22, 'Butter'),
(23, 'Eggs'),
(24, 'Cheese'),
(25, 'Tomato'),
(26, 'Garlic'),
(27, 'Ginger'),
(28, 'Green Peas'),
(29, 'Spinach'),
(30, 'Paneer');

-- Ingredients Recipes Linking

-- RecipeIngredients Table Insertions
INSERT INTO recipe_ingredients (recipe_id, ingredient_id, measure) VALUES
-- Poha
(1, 1, '2 cups'), -- Flattened Rice
(1, 2, '1 medium, chopped'), -- Onion
(1, 3, '1 tsp'), -- Mustard Seeds
(1, 4, '2, chopped'), -- Green Chilies
(1, 5, '1/2 tsp'), -- Turmeric Powder
(1, 6, '6-8'), -- Curry Leaves
(1, 7, '1 tsp'), -- Lemon Juice
(1, 8, '2 tbsp, chopped'), -- Coriander
(1, 9, 'to taste'), -- Salt

-- Upma
(2, 10, '1 cup'), -- Semolina
(2, 11, '1 cup, diced'), -- Mixed Vegetables
(2, 2, '1 small, chopped'), -- Onion
(2, 3, '1 tsp'), -- Mustard Seeds
(2, 4, '2, slit'), -- Green Chilies
(2, 5, '1/4 tsp'), -- Turmeric Powder
(2, 6, '6-8'), -- Curry Leaves
(2, 9, 'to taste'), -- Salt

-- Masala Dosa
(3, 12, '2 cups'), -- Dosa Batter
(3, 13, '2 medium, boiled and mashed'), -- Potatoes
(3, 2, '1 small, chopped'), -- Onion
(3, 26, '2 cloves, minced'), -- Garlic
(3, 27, '1 inch, grated'), -- Ginger
(3, 5, '1/4 tsp'), -- Turmeric Powder
(3, 9, 'to taste'), -- Salt

-- Aloo Paratha
(4, 16, '2 cups'), -- Wheat Flour
(4, 13, '2 medium, boiled and mashed'), -- Potatoes
(4, 5, '1/4 tsp'), -- Turmeric Powder
(4, 8, '2 tbsp, chopped'), -- Coriander
(4, 9, 'to taste'), -- Salt
(4, 14, 'as needed'), -- Ghee

-- Vegetable Sandwich
(5, 25, '1 medium, sliced'), -- Tomato
(5, 28, '1/4 cup, boiled'), -- Green Peas
(5, 24, '2 slices'), -- Cheese
(5, 9, 'to taste'), -- Salt
(5, 15, 'as needed'), -- Butter

-- Rajma Chawal
(6, 17, '1 cup, cooked'), -- Rice
(6, 18, '1 cup, soaked and boiled'), -- Rajma (Red Kidney Beans)
(6, 25, '2 medium, pureed'), -- Tomato
(6, 26, '2 cloves, minced'), -- Garlic
(6, 27, '1 inch, grated'), -- Ginger
(6, 5, '1/2 tsp'), -- Turmeric Powder
(6, 9, 'to taste'), -- Salt

-- Chole Bhature
(7, 18, '1 cup, soaked and boiled'), -- Chickpeas
(7, 16, '2 cups'), -- Wheat Flour
(7, 25, '2 medium, pureed'), -- Tomato
(7, 26, '2 cloves, minced'), -- Garlic
(7, 27, '1 inch, grated'), -- Ginger
(7, 5, '1/4 tsp'), -- Turmeric Powder
(7, 9, 'to taste'), -- Salt

-- Idli
(8, 12, '2 cups'), -- Idli Batter
(8, 8, '1 tbsp, chopped'), -- Coriander
(8, 9, 'to taste'), -- Salt

-- Sambar
(9, 19, '1 cup, cooked'), -- Toor Dal
(9, 25, '2 medium, pureed'), -- Tomato
(9, 2, '1 small, chopped'), -- Onion
(9, 20, '2 tbsp'), -- Tamarind Pulp
(9, 5, '1/4 tsp'), -- Turmeric Powder
(9, 21, '2 tbsp'), -- Sambar Powder
(9, 6, '6-8'), -- Curry Leaves
(9, 9, 'to taste'), -- Salt

-- Pav Bhaji
(10, 22, '4'), -- Pav Buns
(10, 13, '2 medium, boiled and mashed'), -- Potatoes
(10, 25, '2 medium, pureed'), -- Tomato
(10, 11, '1 cup, diced'), -- Mixed Vegetables
(10, 23, '2 tbsp'), -- Butter
(10, 9, 'to taste'), -- Salt

-- Biryani
(11, 17, '2 cups, cooked'), -- Rice
(11, 11, '1 cup, diced'), -- Mixed Vegetables
(11, 26, '3 cloves, minced'), -- Garlic
(11, 27, '2 inches, grated'), -- Ginger
(11, 29, '2 tbsp'), -- Biryani Masala
(11, 9, 'to taste'), -- Salt

-- Paneer Butter Masala
(12, 30, '200 g, cubed'), -- Paneer
(12, 25, '2 medium, pureed'), -- Tomato
(12, 26, '2 cloves, minced'), -- Garlic
(12, 27, '1 inch, grated'), -- Ginger
(12, 23, '2 tbsp'), -- Butter
(12, 9, 'to taste'), -- Salt

-- Palak Paneer
(13, 31, '1 bunch, blanched'), -- Spinach
(13, 30, '200 g, cubed'), -- Paneer
(13, 26, '2 cloves, minced'), -- Garlic
(13, 27, '1 inch, grated'), -- Ginger
(13, 25, '1 medium, pureed'), -- Tomato
(13, 9, 'to taste'), -- Salt

-- Dal Tadka
(14, 19, '1 cup, cooked'), -- Toor Dal
(14, 25, '1 medium, pureed'), -- Tomato
(14, 2, '1 small, chopped'), -- Onion
(14, 26, '2 cloves, minced'), -- Garlic
(14, 6, '6-8'), -- Curry Leaves
(14, 9, 'to taste'), -- Salt

-- Khichdi
(15, 17, '1 cup, cooked'), -- Rice
(15, 19, '1/2 cup, cooked'), -- Lentils
(15, 11, '1/2 cup, diced'), -- Mixed Vegetables
(15, 3, '1 tsp'), -- Mustard Seeds
(15, 6, '6-8'), -- Curry Leaves
(15, 9, 'to taste'), -- Salt

-- Veg Pulao
(16, 17, '2 cups, cooked'), -- Rice
(16, 11, '1 cup, diced'), -- Mixed Vegetables
(16, 29, '1 tsp'), -- Garam Masala
(16, 8, '2 tbsp, chopped'), -- Coriander
(16, 9, 'to taste'), -- Salt

-- Dhokla
(17, 32, '2 cups'), -- Gram Flour
(17, 3, '1 tsp'), -- Mustard Seeds
(17, 5, '1/4 tsp'), -- Turmeric Powder
(17, 6, '6-8'), -- Curry Leaves
(17, 9, 'to taste'), -- Salt

-- Stuffed Capsicum
(18, 33, '3 large'), -- Bell Peppers
(18, 13, '2 medium, boiled and mashed'), -- Potatoes
(18, 29, '1 tsp'), -- Garam Masala
(18, 8, '2 tbsp, chopped'), -- Coriander
(18, 9, 'to taste'), -- Salt

-- Veg Cutlets
(19, 13, '2 medium, boiled and mashed'), -- Potatoes
(19, 11, '1 cup, diced'), -- Mixed Vegetables
(19, 29, '1 tsp'), -- Garam Masala
(19, 34, '1 cup, breadcrumbs'), -- Bread Crumbs
(19, 9, 'to taste'), -- Salt

-- Gajar Halwa
(20, 35, '2 cups, grated'), -- Carrots
(20, 36, '1 cup'), -- Milk
(20, 37, '1/2 cup'), -- Sugar
(20, 23, '2 tbsp'), -- Butter
(20, 38, '1/4 cup'), -- Cashews
(20, 39, '1/4 cup'), -- Raisins

-- Add for recipes 21 to 30 in similar structure...

-- Kheer
(21, 36, '2 cups'), -- Milk
(21, 17, '1/4 cup, cooked'), -- Rice
(21, 37, '1/2 cup'), -- Sugar
(21, 38, '2 tbsp, chopped'), -- Cashews
(21, 39, '2 tbsp'), -- Raisins

-- Jalebi
(22, 40, '1 cup'), -- All-Purpose Flour
(22, 41, '1 cup'), -- Sugar Syrup
(22, 42, 'as needed'), -- Ghee
(22, 43, '1/4 tsp'), -- Saffron

-- Modak
(23, 44, '2 cups'), -- Rice Flour
(23, 37, '1 cup'), -- Sugar
(23, 45, '1/2 cup, grated'), -- Coconut
(23, 46, '1 tsp'), -- Cardamom Powder

-- Thepla
(24, 16, '2 cups'), -- Wheat Flour
(24, 47, '1 cup, grated'), -- Fenugreek Leaves
(24, 5, '1/4 tsp'), -- Turmeric Powder
(24, 9, 'to taste'), -- Salt
(24, 14, 'as needed'), -- Ghee

-- Pav Bhaji
(25, 13, '3 medium, boiled and mashed'), -- Potatoes
(25, 25, '3 large, pureed'), -- Tomatoes
(25, 2, '2 medium, chopped'), -- Onion
(25, 11, '1 cup, diced'), -- Mixed Vegetables
(25, 48, '2 tbsp'), -- Pav Bhaji Masala
(25, 23, '2 tbsp'), -- Butter
(25, 9, 'to taste'), -- Salt

-- Dosa
(26, 49, '2 cups, fermented'), -- Dosa Batter
(26, 14, 'as needed'), -- Ghee
(26, 13, '1 medium, boiled and mashed'), -- Potatoes
(26, 50, '1/4 cup, chopped'), -- Green Chilies
(26, 6, '6-8'), -- Curry Leaves
(26, 9, 'to taste'), -- Salt

-- Samosa
(27, 51, '2 cups'), -- All-Purpose Flour
(27, 13, '3 medium, boiled and mashed'), -- Potatoes
(27, 11, '1/2 cup, diced'), -- Mixed Vegetables
(27, 29, '1 tsp'), -- Garam Masala
(27, 52, 'as needed'), -- Oil
(27, 9, 'to taste'), -- Salt

-- Chole
(28, 53, '2 cups, soaked and boiled'), -- Chickpeas
(28, 25, '3 medium, pureed'), -- Tomatoes
(28, 2, '2 medium, chopped'), -- Onion
(28, 26, '2 cloves, minced'), -- Garlic
(28, 27, '1 inch, grated'), -- Ginger
(28, 54, '2 tbsp'), -- Chole Masala
(28, 9, 'to taste'), -- Salt

-- Aloo Paratha
(29, 16, '2 cups'), -- Wheat Flour
(29, 13, '2 medium, boiled and mashed'), -- Potatoes
(29, 8, '2 tbsp, chopped'), -- Coriander
(29, 50, '1/4 cup, chopped'), -- Green Chilies
(29, 9, 'to taste'), -- Salt
(29, 14, 'as needed'), -- Ghee

-- Gulab Jamun
(30, 55, '1 cup'), -- Khoya
(30, 40, '2 tbsp'), -- All-Purpose Flour
(30, 41, '2 cups'), -- Sugar Syrup
(30, 14, 'as needed'), -- Ghee
(30, 43, '1/4 tsp'); -- Saffron