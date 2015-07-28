{% extends "templates/base.volt" %}

{% block title %}RSS-feed{% endblock %}

{% block content %}
{{ partial("partials/navigation", ['activeTab': 'rss-feed']) }}

<div class="row">
    <div class="col-md-12">
        <h1>RSS-feed</h1>
        <ul class="list-unstyled">
            {% for article in articles %}
            <li>
                <h3>{{ article['title'] }}</h3>
                <small>{{ article['date'] }}</small>
            </li>
            {% endfor %}
        </ul>
    </div>
</div>
{% endblock %}