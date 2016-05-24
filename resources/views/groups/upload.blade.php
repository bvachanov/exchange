<div class="row">
    <h2>Upload file:</h2>

    {!! Form::open(array('url' => array('group/upload', $group->id ), 'files' => true )) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
        {!! Form::text('name') !!}       
    </div>
    <div class="row">
        {!! Form::file('file') !!}      
    </div>
    <div class="row">
        {!! Form::select('type', $materialTypes, 'Select type') !!}      
    </div>
    
    <div class="row">
        {!!Form::hidden('has_end_date',0)!!}
        <input type="checkbox" name='has_end_date' id='hasDueDate' value="1" checked="true">Has End Date</input>
        <p>Date: <input type="text" name='end_date' id="datepicker" readonly="readonly" value="{{$today}}"></p>
    </div>
    
        <div class="row">
        {!!Form::hidden('is_public',0)!!}
        <input type="checkbox" name="is_public" id='assignToAllCheckbox' value="1" checked="true">all students</input>
        <div class="row" id='studentsCheckboxes' style="display: none;">
            @foreach($students as $student)
            <div class="row">
                <input type="checkbox" name="students[]" value="{{$student->user_id}}" checked="true">{{$student->faculty_number}}</input>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        {!! Form::submit('submit') !!}

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
        $('#hasDueDate').change(function () {
            if ($(this).is(':checked')) {
                $("#datepicker").show();
            } else {
                $("#datepicker").hide();
            }
        });

    });
</script>