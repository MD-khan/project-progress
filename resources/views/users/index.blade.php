@extends('layouts.app')

@section('css')
<link href="/../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <a href="/users/create" class="pull-right btn btn-success"> Add New User </a>
                  <div class="x_title">
                    <h2> Users  <small class="badge"> Total: {{ $totalUsers }}</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Role</th>
                          <th>Email</th>
                          <th>Start date</th>
                           <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ( $users as $user )
                        <tr>
                          <td> {{  $user->first_name }} {{ $user->last_name }}</td>
                          <td>  @foreach ( $user->roles as $role ) {{ $role->display_name }}  @endforeach </td>
                          <td> {{ $user->email }}</td>
                          <td>  {{ $user->created_at->diffForHumans( )}}</td>
                          <td> {{ $user->isActive() ? "Active" : "Blocked" }}</td>
                          <td> 
                             @if ( Auth::user()->can('user_list_view') )

                             <a href="/users/{{$user->id }}/show" class="btn btn-info btn-sm"> View </a>
                       
                            <a href="/users/{{$user->id }}/edit" class="btn btn-success btn-sm"> Edit </a>
                            <a href="/users/{{$user->id }}/edit" class="btn btn-danger btn-sm"> Block  </a>
                                 @endif
                          </td>
                        </tr>
                        @endforeach 
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>

        
                
@endsection

@section('js')
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

<script>
      $(document).ready(function() {
        
         $("#datatable-buttons").DataTable({  
             dom: "Bfrtip",buttons: [
                {
                  extend: "copy",
                  className: "btn-sm btn-primary"
                },
                {
                  extend: "csv",
                  className: "btn-sm btn-warning"
                },
                {
                  extend: "excel",
                  className: "btn-sm btn-success"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm btn-success"
                },
                {
                  extend: "print",
                  className: "btn-sm btn-info"
                },
              ],

            responsive: true,

            'order': [[ 1, 'asc' ]]


         });
      });
    </script>
@endsection
