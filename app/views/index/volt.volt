{# e or escape filter #}
{{ "<h1>Hello<h1>"|e }}
{{ "<h1>Hello<h1>"|escape }}

{# trim filter #}
{{ "   hello   "|trim }}

{# striptags filter #}
{{ "<h1>Hello<h1>"|striptags }}

{# slashes filter #}
{{ "'this is a string'"|slashes }}

{# stripslashes filter #}


{# capitalize filter #}
{{ "hello"|capitalize }}

{# lower filter #}
{{ "HELLO"|lower }}

{# upper filter #}
{{ "hello"|upper }}

{# length filter #}
{{ "robots"|length }}
{{ [1, 2, 3]|length }}

{# nl2br filter #}
{{ "some\ntext"|nl2br }}

{# sort filter #}
{% set sorted = [3, 1, 2]|sort %}

{# keys filter #}
{% set keys = ['first': 1, 'second': 2, 'third': 3]|keys %}

{# join filter #}

{# format filter #}

{# json_encode filter #}
{% set myArray = {'Apple', 'Banana', 'Orange'}|json_encode  %}

{# json_decode filter #}
{% set decoded = '{"one":1,"two":2,"three":3}'|json_decode %}