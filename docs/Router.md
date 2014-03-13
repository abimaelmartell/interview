# Router

Find the best match possible, even if it's not perfect.

## Example

Having added the following paths:

* `/foo` returns `callback01`
* `/foo/bar` returns `callback02`

The following requests:

* `/` should throw an exception, as no path is matched
* `/foo` should return `callback01`
* `/foo/bar` should return `callback02`
* `/foo/bartender` should return `callback01`, with the remaining steps provided as additional params (in this case, `"bartender"`)
* `/foo/bar/tender` should return `callback02` with param `"tender"`
* `/foo/bar/tender/ly` should return `callback02` with params `"tender"` and `"ly"`
* `/foobar` should throw an exception
* `/foo/var/tender/ly` should return `callback01` with params `"var"`, `"tender"` and `"ly"`
