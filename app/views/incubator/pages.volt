{% if pager|length() == 0 %}
    <p>Sorry nothing found</p>
{% else %}
    <ul>
    {% for item in pager %}
        <li>{{ item }}</li>
    {% endfor %}
    </ul>

    {% if pager.haveToPaginate() %}
        {# Render the navigation #}
        {{ pager.getLayout() }}
    {% endif %}
{% endif %}