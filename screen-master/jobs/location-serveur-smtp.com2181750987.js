

    var page = require('webpage').create();

    page.viewportSize = { width: 1024, height: 768 };

    

    page.open('http://location-serveur-smtp.com', function () {
        page.render('location-serveur-smtp.com760163510_1024_768.jpg');
        phantom.exit();
    });


    