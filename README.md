# AirAsia Rewards - Gift Card Management

## HW3: PHP and SQL Integration

This project is a PHP web application that manages gift cards for the AirAsia Rewards Redemption System.

It builds upon HW1 and HW2 by replacing static gift card information with a SQLite database and implementing Create, Read, Update, and Delete (CRUD) functionality.

## Technologies Used

- PHP
- SQLite
- PDO (PHP Data Objects)
- HTML5
- CSS3
- GitHub Codespaces

## Database

The database is located at `database/rewards.db`.

The application uses two tables:

### ACCOUNT
- accountId (Primary Key)
- userId
- accountType
- points

### GIFTCARD
- cardId (Primary Key)
- cardName
- cardType
- cardValue
- points

The initial database contains:
- 5 account records
- 20 gift card records

Database setup scripts:
- `database/schema.sql`
- `database/seed.sql`

## How to Run the Application

1. Open the repository in GitHub Codespaces.
2. Open a terminal in the project directory.
3. If the database does not exist, initialize it:

   `sqlite3 database/rewards.db < database/schema.sql`

   `sqlite3 database/rewards.db < database/seed.sql`

4. Start the PHP development server:

   `php -S 0.0.0.0:8000`

5. Open port 8000 in your browser.
6. Navigate to `/card-list.php`.

Do not rerun the seed script against an already populated database because it will insert duplicate records.

## Application Features

- View available gift cards.
- View individual gift card details.
- Add new gift cards.
- Update existing gift cards.
- Delete gift cards after confirmation.
- Validate submitted gift card information.
- Display database records dynamically.

## Use Case Traceability


| Use Case | PHP Page(s) | Database Table | Test Evidence |
|---|---|---|---|
| View a List of Gift Cards | card-list.php | GIFTCARD | Opened the Gift Card List and verified that all 20 records appeared with names, images, and points. |
| View Details of One Gift Card | card-details.php | GIFTCARD | Selected a gift card and confirmed its name, type, value, and points displayed correctly. |
| Add a Gift Card | card-add.php | GIFTCARD | Added a Dinosaur World Gift Card and verified that the new record appeared in the list. |
| Update a Gift Card | card-update.php | GIFTCARD | Updated the Dinosaur World Gift Card and confirmed that the changes appeared on its details page. |
| Delete a Gift Card | card-delete.php | GIFTCARD | Confirmed deletion of the test gift card and verified that the database returned to 20 gift cards. |


## Shared Components

- `includes/header.php` - Shared page header
- `includes/nav.php` - Navigation menu
- `includes/footer.php` - Shared footer
- `includes/db.php` - PDO database connection
- `includes/validation.php` - Reusable validation functions

## Testing

### Automated Validation Tests

Run:

`php tests/validation-tests.php`

Five automated validation tests verify:

1. Valid gift card information
2. Missing card name
3. Invalid card type
4. Negative card value
5. Invalid points

Results: 5 passed, 0 failed.

### Manual Testing

Eight manual test cases (T01-T08) are documented in `test-report.md`.

Results: 8 passed, 0 failed.

## Security and Validation

- PDO prepared statements are used for database operations involving user input.
- Server-side validation checks gift card information.
- Output is escaped using `htmlspecialchars()`.
- Gift card IDs are validated as positive integers.
- Deletion requires confirmation through a POST request.

## AI Assistance

AI assistance was used during development for code guidance, debugging, and testing.

See `ai-use.txt` for additional details.

## Assignment Scope

This submission implements the five gift card management use cases required for HW3.

Login, authorization, customer management, and redemption functionality are outside the scope of HW3.
