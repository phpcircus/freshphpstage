<!DOCTYPE html>
<html class="bg-gray-200">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link href="{{ mix('/css/main.css') }}" rel="stylesheet">
        <script src="{{ mix('/js/main.js') }}" defer></script>
        <meta name="twitter:card" content="summary" id="twitterCard">
        <meta name="twitter:creator" content="@devcircus" id="twitterCreator">
        <meta name="twitter:image" content="https://res.cloudinary.com/phpstage/image/upload/c_scale,w_120/v1558860620/img/devcircus.jpg" id="twitterCreator">
        <meta name="og:url" content="https://phpstage.com/" id="twitterUrl">
        <meta name="og:title" content="PHPStage.com" id="twitterTitle">
        <meta name="og:description" content="See the latest from PHPStage.com" id="twitterDescription">
        @routes
    </head>

    <body class="font-lato leading-none text-gray-900 antialiased">

        <div id="app" data-page="{{ json_encode($page) }}">
            <vue-snotify></vue-snotify>
        </div>

    </body>

</html>
