{{ Form::label('title'); }}
{{ Form::text('title'); }} <br/>
{{ Form::label('slug'); }}
{{ Form::text('slug'); }} <br/>
{{ Form::label('description'); }}
{{ Form::text('description'); }} <br/>
{{ Form::label('html'); }}
{{ Form::text('html'); }} <br/>
{{ Form::label('css'); }}
{{ Form::text('css'); }} <br/>
{{ Form::label('js'); }}
{{ Form::text('js'); }} <br/>
{{ Form::label('author'); }}
{{ Form::text('author'); }} <br/>
{{ Form::label('category'); }}
{{ Form::text('category'); }} <br/>
{{ Form::label('status'); }}
{{ Form::select('status', array( 'draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived')); }} <br/>
{{ Form::label('comments'); }}
{{ Form::text('comments'); }} <br/>

{{ Form::submit('Click Me!'); }}
