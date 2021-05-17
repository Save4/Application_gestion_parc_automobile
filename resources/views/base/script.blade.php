<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.css')}}"></script>
<script src="{{ asset('assets/js/popper.min.js')}}"></script>
<!-- Bootstrap 4 -->
 <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- AdminLTE App -->
 <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>

<!-- waves effect js -->
<script src="{{ asset('assets/js/waves.js')}}"></script>
<!-- Custom scripts -->
<script src="{{ asset('assets/js/app-script.js')}}"></script>



  <!--Data Tables js-->
  <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('js/dataTables.buttons.min.js')}}"></script>
  <script src="{{ asset('js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('js/jszip.min.js')}}"></script>
  <script src="{{ asset('js/pdfmake.min.js')}}"></script>
  <script src="{{ asset('js/vfs_fonts.js')}}"></script>
  <script src="{{ asset('js/buttons.html5.min.js')}}"></script>
  <script src="{{ asset('js/buttons.print.min.js')}}"></script>
  <script src="{{ asset('js/buttons.colVis.min.js')}}"></script>

	<script>
		var route = "{{URL::to('/')}}";
	</script>
  <script src="{{asset('js/prixachat.js')}}"></script>
  <script src="{{asset('js/prixvente.js')}}"></script>

    <script>
     $(document).ready(function() {
      //Default data table
       $('#default-datatable').DataTable();


       var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
      } );

     table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );

      } );

    </script>
