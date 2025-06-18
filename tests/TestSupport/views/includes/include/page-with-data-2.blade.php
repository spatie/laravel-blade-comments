This is the start of the page

@include('includes.include.include', ['timestamp' => auth()->user()?->previous_login_at])

<p>Some extra HTML to test the regex functionality properly</p>
<div class="font-bold text-success">
    {{ auth()->user()?->ip_previous_login }}
</div>

@include('includes.include.include', [
    'timestamp' => (
        (auth()->user()?->previous_login_at ?? '2025-05-10') === '2025-05-10'
        && (1 == 1 || 2 != 1)
        && (fn() => true) === true
     ) ? 'test' : 'test2'
])

<p>Some extra HTML to test the regex functionality properly</p>
<div class="font-bold text-success">
    {{ auth()->user()?->ip_previous_login }}
</div>

This is the end of the page
