<meta charset="utf-8" />

<h2>Welcome</h2>
<pre>
<b>Account:</b> {{{ $email }}}

    To activate your account, <a href="{{ URL::to('/user/account') }}/{{ $userId }}/activate/{{ urlencode($activationCode) }}">click
        here.</a>

Or point your browser to this address:
    {{ URL::to('/user/account') }}/{{ $userId }}/activate/{{ urlencode($activationCode) }}

    Thank you
</pre>