<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{% block title %} {% endblock %} - Test App</title>

    <link href="stylesheets/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Test App</a>
            </div>
        </div>
    </nav>
    <div class="container">
        {% block content %} {% endblock %}
    </div>
    <footer>
        <div class="container">
            <p class="text-muted">Created by Michał Zydroń</p>
        </div>
    </footer>
</body>
</html>
