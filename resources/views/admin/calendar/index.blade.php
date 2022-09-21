@extends('admin.layouts.master')
@section('title')
جدول الشيكات
@stop

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> --}}







@section('content')



  <div class="content-wrapper">
    <section class="content-header">
      <h1>التقويم</h1>
      <ol class="breadcrumb">
          <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
          <li class="active">التقويم</li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
          <div class="box-header with-border">
      <div class="response"></div>
      <div id='calendar'></div>
  </div>
</div>
</div>
  @endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>


  <script>

    $(document).ready(function () {
    var SITEURL = "{{url('/')}}";
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('#calendar').addTouch();
    var calendar = $('#calendar').fullCalendar({
    editable: true,
    events: SITEURL + "/dashboard/Calendar",
    displayEventTime: true,
    editable: true,
    eventRender: function (event, element, view) {
    if (event.allDay === 'true') {
    event.allDay = true;
    } else {
    event.allDay = false;
    }
    },
    selectable: true,
    selectHelper: true,
    select: function (start, end, allDay) {
    var title = alert('is goggd');
    if (title) {
    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
    $.ajax({
    url: SITEURL + "/dashboard/Calendar/create",
    data: 'title=' + title + '&start=' + start + '&end=' + end,
    type: "GET",
    success: function (data) {
    displayMessage("Added Successfully");
    }
    });
    calendar.fullCalendar('renderEvent',
    {
    title: title,
    start: start,
    end: end,
    allDay: allDay
    },
    true
    );
    }
    calendar.fullCalendar('unselect');
    },
    eventDrop: function (event, delta) {
    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
    $.ajax({
    url: SITEURL + '/dashboard/Calendar/update',
    data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
    type: "PUT",
    success: function (response) {
    displayMessage("Updated Successfully");
    }
    });
    },
    eventClick: function (event) {
    var deleteMsg = confirm("Do you really want to delete?");
    if (deleteMsg) {
    $.ajax({
    type: "delete",
    url: SITEURL + '/dashboard/Calendar/delete',
    data: "&id=" + event.id,
    success: function (response) {
    if(parseInt(response) > 0) {
    $('#calendar').fullCalendar('removeEvents', event.id);
    displayMessage("Deleted Successfully");
    }
    }
    });
    }
    }
    });
    });
    function displayMessage(message) {
    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
    }
    </script>
 @endsection
