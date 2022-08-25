<html>
    <head></head>
    <body>
        <form action="/form" method="POST">
            <label for="name">
                <input type="text" name="name">
            </label>
            <input type="submit" value="say hello">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
    </body>
</html>