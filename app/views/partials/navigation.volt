<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li role="presentation" {% if activeTab is 'varnish-log' %}class="active"{% endif %}>
                <a href="{{ url('varnish-log') }}">Varnish log</a>
            </li>
            <li role="presentation" {% if activeTab is 'rss-feed' %}class="active"{% endif %}>
                <a href="{{ url('rss-feed') }}">RSS-feed</a>
            </li>
            <li role="presentation" {% if activeTab is 'json-feed' %}class="active"{% endif %}>
                <a href="{{ url('json-feed') }}">JSON-feed</a>
            </li>
        </ul>
    </div>
</div>