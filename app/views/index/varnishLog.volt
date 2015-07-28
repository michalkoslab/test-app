{% extends "templates/base.volt" %}

{% block title %}Varnish log{% endblock %}

{% block content %}
{{ partial("partials/navigation", ['activeTab': 'varnish-log']) }}

<div class="row">
    <div class="col-md-12">
        <h1>Varnish log</h1>
        <h3>5 hostnames with the most traffic</h3>
        <ol>
            {% for hostname in hostnames %}
            <li>{{ hostname }}</li>
            {% endfor %}
        </ol>
        <h3>5 most requested files</h3>
        <ol>
            {% for file in files %}
            <li>{{ file }}</li>
            {% endfor %}
        </ol>
    </div>
</div>
{% endblock %}