{{ content() }}

<h2>phalcon2 搜索测试</h2>
{{ form( 'class': 'form-inline','action':'db/pages') }}
    <div>
        <div class="form-group">
            <div class="controls">
                name:<input type="text" name="name" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="controls">
                email:<input type="text" name="email" class="form-control">
            </div>
        </div>

        <div class="control-group">
            {{ submit_button("搜索记录", "class": "btn btn-primary") }}
        </div>
    </div>
</form>


{% for item in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Registration_date</th>
        </tr>
    </thead>
    <tbody>
    {% endif %}
        <tr>
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
			<td>{{ item.email }}</td>
			<td>{{ item.address }}</td>
			<td>{{ item.registration_date }}</td>
        </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("db/pages", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("db/pages?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("db/pages?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("db/pages?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
    {% endif %}
{% else %}
    No products are recorded
{% endfor %}
