<div class="row">
    <h2>{{trans('translations.uploadSolution')}}</h2>

    {!! Form::open(array('url' => array('studassignment/upload', $assignment->id ), 'files' => true )) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
 
    <div class="row">
        {!! Form::label('file', trans('translations.uploadFile')) !!}
        {!! Form::file('file', ['class'=>'form-control']) !!}      
    </div>
   
    <div class="row">
        <button class="submitButton"> {{trans('translations.upload')}}</button>

    </div>


    {!! Form::close() !!}

</div>
