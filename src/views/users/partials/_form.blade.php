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
        {{ Form::select('status', array( 'inactive' => 'Inactive', 'active' => 'Active')) }}
    </p>
    <p>
        {{ Form::label('role') }}
        {{ Form::select('role', array('administrator' => 'Admin', 'editor' => 'Editor', 'user' => 'User')) }}
    </p>
</fieldset>

<fieldset class="half split">
    <p>
        {{ Form::label('username') }}
        {{ Form::text('username') }}
    </p>
    <p>
        {{ Form::label('password') }}
        {{ Form::password('password') }}
    </p>
    <p>
        {{ Form::label('email') }}
        {{ Form::text('email') }}
    </p>
</fieldset>
