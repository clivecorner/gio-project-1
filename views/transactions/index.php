<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Transaction upload</title>
    </head>
    <body>

        <h2>Upload CSV Files</h2><br>
        <p>Select CSV files to upload:</p>
        <p>
            <form action="/transactions/upload"  method="post" enctype="multipart/form-data" >
                <input type="file"  name="transactions[]" multiple /></br></br>
                <button type="submit">Click to submit</button>
            </form>
        </p>


    </body>
</html>
