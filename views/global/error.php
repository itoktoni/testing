
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Page Not Found</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
                line-height: 1.2;
                margin: 0;
            }
            html {
                color: #888;
                display: table;
                font-family: sans-serif;
                height: 100%;
                text-align: center;
                width: 100%;
                background-color: #2b2453;
            }
            body {
                display: table-cell;
                vertical-align: middle;
                margin: 2em auto;
            }
            h1 {
                color: white;
                font-size: 2em;
                font-weight: 400;
            }
            p {
                margin: 0 auto;
                width: 280px;
            }

            a{
                color: #717fe0;
            }
            @media only screen and (max-width: 280px) {
                body, p {
                    width: 95%;
                }
                h1 {
                    font-size: 1.5em;
                    margin: 0 0 0.3em;
                }
            }
        </style>
    </head>
    <body>
        <h1>Access Deny !</h1>
        <p>Sorry, you can't access this page.</p>
        <br />
        <a href="<?php echo Yii::$app->user->returnUrl; ?>">Return to previous page</a>
    </body>
</html>