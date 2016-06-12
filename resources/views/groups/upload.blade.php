<div class="row">
    <h2>{{trans('translations.uploadFile')}}:</h2>

    {!! Form::open(array('url' => array('group/upload', $group->id ), 'files' => true )) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
        {!! Form::label('name', trans('translations.name')) !!}
        {!! Form::text('name', '' , ['class'=>'form-control']) !!}       
    </div>
    <div class="row">
          {!! Form::label('file', trans('translations.uploadFile')) !!}
        {!! Form::file('file', ['class'=>'form-control']) !!}      
    </div>
    <div class="row">
        {!! Form::label('type', trans('translations.materialType')) !!}
        {!! Form::select('type',  $materialTypes, null,['id'=>'type', 'placeholder'=>'Select type' , 'class'=>'form-control']) !!}      
    </div>
    
    <div class="row" id='datepickerRow' style="display:none;">
        <p>{{trans('translations.endDate')}}: <input type="text" name='end_date' id="datepicker" readonly="readonly" value="{{$today}}"></p>
    </div>
    
    <div class="row" id='studentsDiv' style="display: none;">
        {!!Form::hidden('is_public',0)!!}
        <p>{{trans('translations.assignedTo')}}:</p>
        <input type="checkbox" name="is_public" id='assignToAllCheckbox' value="1" checked="true">{{trans('translations.allStudents')}}</input>
        <div class="row" id='studentsCheckboxes' style="display: none;">           
            @foreach($students as $student)
            <div class="col-md-2 col-sm-3 col-sm-6">
                <input type="checkbox" name="students[]" value="{{$student->user_id}}" checked="true"><a href='{{url('/user/show', $student->user_id)}}'>{{$student->faculty_number}}</a></input>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <!--{!! Form::submit(trans('translations.upload')) !!}-->
         <button class="submitButton"> {{trans('translations.upload')}}</button>

    </div>


    {!! Form::close() !!}

</div>

<script>
    $(document).ready(function () {
        $("#datepicker").datepicker({minDate: 0, dateFormat: 'yy/mm/dd'});
        $('#assignToAllCheckbox').change(function () {
            if ($(this).is(':checked')) {
                $("#studentsCheckboxes").hide();
            } else {
                $("#studentsCheckboxes").show();
            }
        });
        $('#type').change(function () {
            if ( $(this).val()==1 || $(this).val()==4 ) {
                $("#datepickerRow").hide();
                $("#studentsDiv").hide();
                
            } else {
                $("#datepickerRow").show();
                $("#studentsDiv").show();
            }
        });

    });
</script>