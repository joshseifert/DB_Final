Brief description of this gigantic jumble of source files:

header.php and footer.php are to create the header and footer on each page. Include in every web page.

functions.js contains all the JavaScript functions right now. Currently only have a single function, to let player confirm if they want to delete something from the DB. May expand later, considering time and/or motivation.

userinfo.php is my database connection, and instantiates a mysqli object. Not included on github, emailed to you personally for security reasons.

Pages user sees are:
main (just the page with the buttons to other parts. Maybe include an "about" here.
stadium / team / player / game - the pages with the add/insert/delete functions. If there are small mySQLi functions only relevant to these parts, they are included in these pages.

insert*, delete*, these are the slightly longer mySQLi statements, kept in separate files for ease of reading. Since fancy web design isn't the primary concern of this project, I decided not to use AJAX. Every mySQLi query refreshes the web page, so make sure that after these pages finish running, you header them back to the page they original from.