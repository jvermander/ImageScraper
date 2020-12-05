// Returns a string of HTML, post-javascript execution

var URL = 'https://www.ubereats.com/ca/vancouver/food-delivery/hon-sushi/XAAB10yNTL6wz9qbi2gXfA';
var webPage = require('webpage');
var page = webPage.create();
page.viewportSize = {width: 1280, height: 1000000}; // load all images without scrolling, since they are lazy loaded
page.open(URL, function () {
        console.log(page.content)
        phantom.exit();
});