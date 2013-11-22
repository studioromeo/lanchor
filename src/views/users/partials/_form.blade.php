<fieldset class="half split">
    <p>
        {{ Form::label('real_name') }}
        {{ Form::text('real_name') }}
    </p>
    <p>
        {{ Form::label('bio', 'Biography') }}
        {{ Form::textarea('bio', null, array('cols' => 20)) }}
    </p>
    <p>
        {{ Form::label('status') }}
        {{ Form::select('status', array('Inactive', 'Active')) }}
    </p>
    <p>
        {{ Form::label('role') }}
        {{ Form::select('role', array('Admin', 'Editor', 'User')) }}
    </p>
</fieldset>

<fieldset class="half split">
    <p>
        {{ Form::label('username') }}
        {{ Form::text('username') }}
    </p>
    <p>
        {{ Form::label('password') }}
        {{ Form::text('password') }}
    </p>
    <p>
        {{ Form::label('email') }}
        {{ Form::text('email') }}
    </p>
</fieldset>
