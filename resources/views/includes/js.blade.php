@section('lower_javascript')
<script>
    $(document).ready(function() {
        var events = '{!!  $myevents  !!}';

        $("#calendar").fullCalendar({
            header: {
                left: "prev,next today",
                center: "title",
                right: "month,basicWeek,basicDay"
            },
            defaultDate: "{{ Carbon\Carbon::now()->format('Y-m-d') }}",
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                {!!  $myevents  !!}
            ]
        });
    });
      $(document).ready(function() {
$('#main_type').change(function(){
  var data= $(this).val();
  
  $('#type').empty();

            var newOption = $('<option value="">{{ __('website.Select Event Category') }}</option>');
                    $('#type').append(newOption);
                    
                      $_token = "<?php echo e(csrf_token(), false); ?>";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: "<?php echo route('get_main_types') ; ?>",
            type: 'POST',
            cache: false,
            data: {'type':data, '_token': $_token }, //see the $_token
            // datatype: 'html',
            beforeSend: function() {
                //something before send



            },
            success: function(data) {
                data.forEach(function(entry) {

                    var newOption = $('<option value="'+entry.id+'">'+entry.name_en+'</option>');
                    $('#type').append(newOption);

                });
                $('#type').trigger('liszt:updated');
            }
        });
  
  
});
});
    // $(document).on("click", function () {
    //     console.log($("#showfiltermenu").hide());
    //     console.log($("#showfilter").hide());
    // });

</script>
@endsection
