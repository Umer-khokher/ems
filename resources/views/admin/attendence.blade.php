<x-dashboard-layout>
  <x-slot name="pageName">{{ $pageName }}</x-slot>
  <x-slot name="breadCrumbs">
    <x-admin.breadcrumbs :pageName="$pageName" :breadCrumbs="$breadCrumbs" />
  </x-slot>
  <x-slot name="inPageCss">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  </x-slot>
  <x-slot name="inPageJs">
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

  
    <!-- Page specific script -->
    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* Add custom styles for dropdown and form */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 5rem;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    .tdlin {
      position: relative;
    }
    .tdlin:hover .dropdown-content {
      display: block;
    }
  </style>
    <style>
.table-bordered td{
  width: 2.75rem;
  height: 30px;
}
.table-bordered td, .table-bordered th {
    text-align: center;
} 
.tdlin{
  display: block;
  width: 100%;
  height: 100%;
}
.detail{
    float: right;
    font-size: 1.1rem;
    font-weight: 400;
    margin: 0;
    padding: 0 1rem 0 1rem;
}
.blocksd{
  width: 2.75rem;
  height: 30px;
}
.r{
 background-color: red;
}
.g{
 background-color: green;
}
.b{
 background-color: gray;
}
.y{
 background-color: yellow;
}
.p{
 background-color: purple;
}
/* >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> */
#attendanceeditDiv {
  display: none;
}

    </style>
<style>
    /* Define secondary classes for status colors */
    .status-absent {
        background-color: red;
        color: white;
    }
    .status-present {
        background-color: green;
    }
    .status-late {
        background-color: gray;
        color: white;
    }
    .status-leave {
        background-color: yellow;
        color: black;
    }
    /* Define the purple cell header class for weekends */
    .purple-header,
    .purple-cell {
        background-color: purple;
        color: white;
    }
</style>
  </x-slot>


  <div class="container-fluid">
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

  @if(session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">User Attendance</h3>
            
            <div style="display: flex; float: right;">
              <div class="blocksd r"></div>
              <h3 class="detail">For Absent</h3>
            
              <div class="blocksd g"></div>
              <h3 class="detail">For Present</h3>
            
              <div class="blocksd b"></div>
              <h3 class="detail">For Late</h3>
              
              <div class="blocksd y"></div>
              <h3 class="detail">For Leave</h3>
              
              <div class="blocksd p"></div>
              <h3 class="detail">For Weekend</h3>
              
            </div>
          </div>
          <div class="card-body">
            <div class="py-12">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                </div>
              </div>
            </div>
          
            <table class="table-bordered">
    <thead>
        <tr>
            <th>Sr. #</th>
            <th>User ID</th>
            @for ($day = 1; $day <= 31; $day++)
                @php
                    $dayOfWeek = date('D', strtotime('2023-07-' . $day)); // Get abbreviated day name
                    $isWeekend = $dayOfWeek === 'Sat' || $dayOfWeek === 'Sun'; // Check if weekend day
                    $headerClass = $isWeekend ? 'purple-header' : '';
                @endphp
                <th class="{{ $headerClass }}">{{ $day }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @php
            $usersAttendanceData = [];
        @endphp

        {{-- Transform data into user-wise attendance array --}}
        @foreach ($attendanceHistory as $index => $record)
            @php
                $userId = $record->user_id;
                $status = strtolower($record->status);
                $date = date('j', strtotime($record->created_at));
                $id = $record->id;
                $createdAt = date('Y-m-d H:i:s', strtotime($record->created_at)); // Format the 'created_at' date
                $checkedInAt = "Checked in at {$createdAt}"; // Tooltip text
                if (!isset($usersAttendanceData[$userId])) {
                    $usersAttendanceData[$userId] = [
                        'user_id' => $userId,
                        'attendance' => array_fill(1, 31, ''),
                    ];
                }

                $usersAttendanceData[$userId]['attendance'][$date] = [
                'status' => $status,
                'created_at' => $checkedInAt,
                'id' => $id,
              ];
            @endphp
        @endforeach
        @foreach ($usersAttendanceData as $index => $userAttendance)
            <tr>
                <td>{{ $index }}</td>
                <td>{{ $userAttendance['user_id'] }}</td>
                @for ($day = 1; $day <= 31; $day++)
                @php
                    $attendanceData = $userAttendance['attendance'][$day] ?? null;
                    $status = $attendanceData['status'] ?? '';
                    $created_at = $attendanceData['created_at'] ?? '';
                    $id = $attendanceData['id'] ?? ''; // Fetch the 'id' from the attendance data
                    $dayOfWeek = date('D', strtotime('2023-07-' . $day)); // Get abbreviated day name
                    $isWeekend = $dayOfWeek === 'Sat' || $dayOfWeek === 'Sun';
                    $cellClass = $isWeekend ? 'purple-cell ' : '';
                    $cellClass .= 'status-' . $status;
                @endphp
                <td class="{{ $cellClass }}" data-attendance-id="{{ $id }}">
                                <div class="tdlin">
                                    <!-- Clicking on this <a> tag will toggle the form -->
                                    <a href="#">
                                        <!-- Add any content you want to show in the <td> -->
                                        
                                    </a>                                       
                                    </div>
                                </div>
                            </td>
                @endfor
            </tr>
        @endforeach
    </tbody>
</table>
          </div> 
        </div>
      </div>   
    </div>
    <div id="attendanceeditDiv">
  <div class="row" style="justify-content: center">
    <div class="col-3">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit the Selected Entry</h3>
        </div>
        <div class="card-body">
          <form id="attendanceForm" action="{{ route('admin.attendence.edit', ['id' => '']) }}" method="post" style="display: none;">
          @csrf
            <input type="hidden" name="status" value="">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="new_status">Status</label>
                  <select class="status-select form-control" name="new_status">
                    <option value="" >--Select--</option>
                    <option value="present" class="g">Present</option>
                    <option value="absent" class="r">Absent</option>
                    <option value="late" class="b">Late</option>
                    <option value="leave" class="y">Leave</option>
                  </select>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
  $(document).ready(function () {
    // Handle click on tdlin (td) element
    $(".tdlin").click(function (event) {
      event.stopPropagation(); // Prevent event bubbling to the tr element

      // Get the form and update its action attribute with the appropriate ID
      var form = $("#attendanceForm");
      var td = $(this).closest("td");
      var attendanceId = td.data("attendance-id");

      // Ensure that attendanceId is treated as a string
      attendanceId = String(attendanceId).trim();

      // Remove any leading or trailing slashes from the attendanceId, if present
      attendanceId = attendanceId.replace(/^\/|\/$/g, '');

      form.attr("action", "{{ route('admin.attendence.edit', ['id' => '']) }}" + attendanceId);

      // Show the form beside the clicked TD
      var position = td.position();
      var top = position.top + td.height();
      var left = position.left;
      form.css({ top: top, left: left }).show();

      // Hide the attendanceTableDiv when a td is clicked
      $("#attendanceTableDiv").hide();

      // Show the attendanceeditDiv when a td is clicked
      $("#attendanceeditDiv").show();
    });

    // Prevent hiding the attendanceeditDiv when clicking inside it
    $("#attendanceeditDiv").click(function (event) {
      event.stopPropagation();
    });

    // Handle click on the document to hide the dropdown when clicking outside of it
    $(document).click(function (event) {
      $(".dropdown-content").hide();

      // Show the attendanceTableDiv when clicking outside of a td
      $("#attendanceTableDiv").show();

      // Hide the attendanceeditDiv when clicking outside of a td
      $("#attendanceeditDiv").hide();
    });
  });
</script>
<script>
  $(document).ready(function () {
    // ... (existing code) ...

    // Handle form submission via AJAX on select change
    $(".status-select").change(function (event) {
      
      event.stopPropagation(); // Prevent event bubbling to the document
      var selectedStatus = $(this).val();
      var form = $(this).closest("form");
      form.find("input[name='status']").val(selectedStatus);
      alert(form.attr("action"));
      // AJAX form submission
      $.ajax({
        url: form.attr("action"),
        method: form.attr("method"),
        data: form.serialize(),
        success: function (response) {
          console.log(response)
          // Handle success response, if needed

          // Show the success message (if available) and update the page accordingly
          if (response.status == 'success') {
            // Show the success message using a suitable method (e.g., alert, toast, etc.)
            alert(response.message);
            // $('.cell'+id).removeClass('status-late');
            // $('.cell'+id).removeClass('status-present');
            // $('.cell'+id).removeClass('status-leave');
            
            // $('.cell'+id).addClass('status-late');
          }else {
            alert(response.message);
          }
        },
        error: function (xhr, status, error) {
          // Handle error response, if needed
          console.error("Form submission failed!");
          alert("An error occurred during the form submission.");
        },
      });

      // Show the attendanceTableDiv after form submission
      $("#attendanceTableDiv").show();

      // Hide the attendanceeditDiv after form submission
      $("#attendanceeditDiv").hide();
    });

    // Handle form submission via AJAX when submit button is clicked
    $("#submitBtn").click(function (event) {
      event.preventDefault(); // Prevent the default form submission

      var form = $(this).closest("form");
      var selectedStatus = form.find(".status-select").val();
      form.find("input[name='status']").val(selectedStatus);

      // AJAX form submission
      $.ajax({
        url: form.attr("action"),
        method: form.attr("method"),
        data: form.serialize(),
        success: function (response) {
          // Handle success response, if needed
          console.log("Form submitted successfully!");

          // Show the success message (if available) and update the page accordingly
          if (response.success) {
            // Show the success message using a suitable method (e.g., alert, toast, etc.)
            alert(response.success);

            // Update the page content if needed (e.g., refresh the table or update some elements)
            // ...

            // Reload the page to reflect the changes in the table, if necessary
            //window.location.reload();
          }
        },
        error: function (xhr, status, error) {
          // Handle error response, if needed
          console.error("Form submission failed!");
          alert("An error occurred during the form submission.");
        },
      });

      // Show the attendanceTableDiv after form submission
      $("#attendanceTableDiv").show();

      // Hide the attendanceeditDiv after form submission
      $("#attendanceeditDiv").hide();
    });
  });
</script>

</x-dashboard-layout>