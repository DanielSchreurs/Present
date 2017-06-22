<?php $placeholder= $cours->total()==0?'un cours':$cours[0]->name;  ?>
{!! Form::label('search_cours','Rechercher une classe',['class'=>'visuallyhidden']) !!}
{!! Form::input('search','search_cours','',['class'=>'box__search','placeholder'=>'ex : '.$placeholder]) !!}