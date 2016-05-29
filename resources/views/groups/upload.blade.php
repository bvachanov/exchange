<div class="row">
    <h2>{{trans('translations.uploadFile')}}:</h2>

    {!! Form::open(array('url' => array('group/upload', $group->id ), 'files' => true )) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
        <p>{{trans('translations.name')}}</p>
        {!! Form::text('name') !!}       
    </div>
    <div class="row">
        {!! Form::file('file') !!}      
    </div>
    <div class="row">
        <p>{{trans('translations.materialType')}}:<p>
        {!! Form::select('type',  $materialTypes, null,['id'=>'type', 'placeholder'=>'Select type']) !!}      
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
        {!! Form::submit(trans('translations.upload')) !!}

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