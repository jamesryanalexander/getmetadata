# getmetadata
php scripts to get meta data from an outside ajax request

In general the consumer needs to send a post request with an action (currently only allowed action is 'title') and url.
This is usually done in JSON but isn't required.

The script will respond back, in JSON (watch for quotes) with the html <title> of the url you sent.

Uses:
PHP5
Apache
PHP5-curl
