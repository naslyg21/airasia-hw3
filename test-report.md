
# HW3 - AirAsia Rewards Gift Card Management
## Test Report

Testing Environment: GitHub Codespaces, PHP, SQLite, PDO

### T01 - Validation Test Harness
- Steps/Input: Run `php tests/validation-tests.php`.
- Expected Result: Five validation tests display PASS.
- Actual Result: All five tests passed with zero failures.
- Status: PASS

### T02 - View Gift Card List
- Steps/Input: Open `card-list.php`.
- Expected Result: Gift cards appear with their names, images, and required points.
- Actual Result: All 20 gift cards appeared with their corresponding brand images.
- Status: PASS

### T03 - View Gift Card Details
- Steps/Input: Select a gift card from the list.
- Expected Result: The selected card displays its name, type, value, and points.
- Actual Result: The selected Amazon Gift Card displayed its correct information.
- Status: PASS

### T04 - Add Gift Card
- Steps/Input: Add Dinosaur World Gift Card, Shopping, $25.00, 3000 points.
- Expected Result: The new gift card is saved and appears in the list.
- Actual Result: The gift card was added successfully and its details were displayed.
- Status: PASS

### T05 - Update Gift Card
- Steps/Input: Open the Dinosaur World Gift Card, edit its information, and submit.
- Expected Result: Updated information is saved and displayed on the details page.
- Actual Result: The update succeeded and returned to the Gift Card Details page.
- Status: PASS

### T06 - Delete Gift Card
- Steps/Input: Open the Dinosaur World Gift Card, select Delete, and confirm.
- Expected Result: The card is deleted and the user returns to the Gift Card List.
- Actual Result: The card was deleted successfully. The database returned to 20 gift cards.
- Status: PASS

### T07 - Invalid or Altered Input Handling
- Steps/Input: Attempt to submit a gift card with a value of zero.
- Expected Result: Invalid data is rejected and not saved.
- Actual Result: The browser prevented submission and required a value of at least 0.01. The automated validation test also rejected a negative card value.
- Status: PASS (browser validation and automated validation verified)

### T08 - Invalid Gift Card Identifier Handling
- Steps/Input: Open `card-details.php?card_id=999999`.
- Expected Result: The application handles a nonexistent gift card safely without crashing.
- Actual Result: The application displayed "Gift Card Not Found" without crashing.
- Status: PASS

## Defects and Corrections

### PHP Syntax Error
- Problem: An extra closing bracket in `card-list.php` caused HTTP Error 500.
- Fix: Removed the duplicate `];` from the image mapping section.
- Retest: Ran `php -n -l card-list.php` and received "No syntax errors detected." Refreshed the website and confirmed that the gift card images displayed correctly.
- Status: RESOLVED
