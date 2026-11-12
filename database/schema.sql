
-- HW3: AirAsia Rewards Gift Card Management
-- SQLite database schema

CREATE TABLE IF NOT EXISTS ACCOUNT (
    accountId INTEGER PRIMARY KEY AUTOINCREMENT,
    userId INTEGER NOT NULL,
    accountType VARCHAR(100) NOT NULL,
    points INTEGER NOT NULL
);

CREATE TABLE IF NOT EXISTS GIFTCARD (
    cardId INTEGER PRIMARY KEY AUTOINCREMENT,
    cardName VARCHAR(100) NOT NULL,
    cardType VARCHAR(100) NOT NULL,
    cardValue REAL NOT NULL CHECK (cardValue > 0),
    points INTEGER NOT NULL CHECK (points > 0)
);
