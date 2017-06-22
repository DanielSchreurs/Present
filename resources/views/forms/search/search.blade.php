{!! Form::label('search','Rechercher',['class'=>'visuallyhidden']) !!}
{!! Form::text('search','',['class'=>'input-search-header','placeholder'=>'Recherchez : un élève, un cours, une classe']) !!}
{!! Form::submit($submit,['class'=>'btn btn--small submit--search visuallyhidden--palm accessibility--lap']) !!}