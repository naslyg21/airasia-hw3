
-- HW3: AirAsia Rewards Gift Card Management
-- Sample data for ACCOUNT and GIFTCARD

-- Five sample accounts
INSERT INTO ACCOUNT (userId, accountType, points) VALUES
(1, 'Standard', 5000),
(2, 'Premium', 12000),
(3, 'Standard', 7500),
(4, 'Premium', 20000),
(5, 'Standard', 3500);

-- Original six gift cards from HW2
INSERT INTO GIFTCARD (cardName, cardType, cardValue, points) VALUES
('Amazon Gift Card', 'Shopping', 50.00, 5000),
('Starbucks Gift Card', 'Food', 25.00, 2500),
('Target Gift Card', 'Shopping', 50.00, 5000),
('Walmart Gift Card', 'Shopping', 50.00, 5000),
('Best Buy Gift Card', 'Technology', 100.00, 10000),
('Apple Gift Card', 'Technology', 100.00, 10000),

-- Fourteen additional gift cards
('Amazon $10 Gift Card', 'Shopping', 10.00, 1000),
('Amazon $25 Gift Card', 'Shopping', 25.00, 2500),
('Starbucks $10 Gift Card', 'Food', 10.00, 1000),
('Target $25 Gift Card', 'Shopping', 25.00, 2500),
('Walmart $25 Gift Card', 'Shopping', 25.00, 2500),
('Best Buy $50 Gift Card', 'Technology', 50.00, 5000),
('Apple $25 Gift Card', 'Technology', 25.00, 2500),
('Google Play $25 Gift Card', 'Technology', 25.00, 2500),
('Netflix $25 Gift Card', 'Entertainment', 25.00, 2500),
('Spotify $10 Gift Card', 'Entertainment', 10.00, 1000),
('Uber $25 Gift Card', 'Travel', 25.00, 2500),
('Uber Eats $25 Gift Card', 'Food', 25.00, 2500),
('Airbnb $50 Gift Card', 'Travel', 50.00, 5000),
('Sephora $25 Gift Card', 'Shopping', 25.00, 2500);