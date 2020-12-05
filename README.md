Image Scraper for Ubereats URL: https://www.ubereats.com/ca/vancouver/food-delivery/hon-sushi/XAAB10yNTL6wz9qbi2gXfA

For simplicity, I wanted to use a regular expression to parse for the images rather than traverse a DOM, so I needed the HTML in plaintext.

The problem for me was that any plaintext I could get from the website in pure PHP would be HTML prior to Javascript execution. The website is dynamically and lazily loaded, so all merchandise is only displayed after being run by a Javascript engine, such as Firefox. So a simple call to <i>get_file_contents</i> in PHP does not return product image URLs. 

To get around this, I used a Javascript library PhantomJS, which I call from within the PHP, in order to first load all image URLs and return the resulting plaintext. This allowed me to parse for images using a regular expression. For each match I simply download the image and construct the required file name, and upload this data to the specified Google Drive.

For pure PHP (without PhantomJS), I would have instead manually downloaded the website after being displayed by a client browser (i.e. Firefox), and then just parse those local files with a regular expression. This is the pure PHP way that I know of, but with the PhantomJS method there is no manual download, and no storage of local files at all; I make a simple HTTP request and transfer its images to the drive.

