-- Seed categories
INSERT INTO categories (name) VALUES 
('Schmuck'),
('Accessoires'),
('Edelsteine'),
('Perlen');

-- Seed admin user
INSERT INTO users (salutation, firstname, lastname, address, postalcode, city, email, username, password, payment_method, role) VALUES
('Frau', 'Admin', 'User', 'Musterstraße 1', '12345', 'Wien', 'admin@bedazzle.com', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'PayPal', 'admin');

-- Seed sample products
INSERT INTO products (name, description, price, picture, category_id, rating) VALUES
('Silberkette', 'Elegante Silberkette aus 925er Sterling Silber', 29.99, 'silver-necklace.jpg', 1, 4.5),
('Goldarmband', 'Hochwertiges Armband aus 18K Gold', 199.99, 'gold-bracelet.jpg', 1, 4.8),
('Seidenschal', 'Handgefertigter Seidenschal mit Blumenmuster', 49.99, 'silk-scarf.jpg', 2, 4.3),
('Diamant-Anhänger', 'Brillanter Diamant-Anhänger mit Zertifikat', 299.99, 'diamond-pendant.jpg', 3, 4.9),
('Süßwasserperlen-Set', 'Exklusives Set aus Süßwasserperlen', 159.99, 'pearl-set.jpg', 4, 4.7);

-- Seed sample coupons
INSERT INTO coupons (code, value, valid_until, redeemed) VALUES
('WELCOME10', 10.00, DATE_ADD(CURRENT_DATE, INTERVAL 30 DAY), FALSE),
('SUMMER25', 25.00, DATE_ADD(CURRENT_DATE, INTERVAL 60 DAY), FALSE); 