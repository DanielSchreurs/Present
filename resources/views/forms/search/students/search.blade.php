<?php $placeholder = $students->total() == 0 ? 'un élève' : $students[0]->fullname; ?>
{!! Form::label('search_student','Rechercher une classe',['class'=>'visuallyhidden']) !!}
{!! Form::input('search','search_student','',['class'=>'box__search','placeholder'=>'ex : '.$placeholder ]) !!}