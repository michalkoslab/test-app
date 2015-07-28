{% extends "templates/base.volt" %}

{% block title %}JSON-feed{% endblock %}

{% block content %}
{{ partial("partials/navigation", ['activeTab': 'json-feed']) }}

<div class="row">
    <div class="col-md-12">
        <h1>JSON-feed</h1>
        <ul class="list-unstyled">
            {% for article in articles %}
            <li>
                <h3>{{ article['title'] }}</h3>
                <ul class="list-unstyled">
                {% for name, value in article %}
                    <li><strong>{{ name }}:</strong> {{ value }}</li>
                {% endfor %}
                </ul>
            </li>
            {% endfor %}
        </ul>
    </div>
</div>
{% endblock %}