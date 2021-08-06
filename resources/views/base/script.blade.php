<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<!--Data Tables js-->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/buttons.colVis.min.js') }}"></script>

<!--<script>
    var route = "{{ URL::to('/') }}";

</script>
<script src="{{ asset('js/autoCharge.js') }}"></script>
<script src="{{ asset('js/prixachat.js') }}"></script>
<script src="{{ asset('js/prixvente.js') }}"></script>-->

<script>
    $(document).ready(function() {
        //Default data table
        $('#default-datatable').DataTable();


        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: [ /*'copy',*/ 'excel', 'pdf', 'print', 'colvis']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });

</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<!-- waves effect js -->
<script src="{{ asset('assets/js/waves.js') }}"></script>
<!-- Custom scripts -->
<!--<script src="{{ asset('assets/js/app-script.js') }}"></script>-->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquuery/3.1.1/jquery.min.js"></script>-->
<!-- auto chargement du modele apres la selection du marque
les donnees proviennent de deux table  (table marque et modele)-->
<script type="text/JavaScript">
    $(document).ready(function(){

        $(document).on('change','.mark_id',function(){
             //console.log("hmm its change");
            let marque=$(this).val();
            let div=$(this).parent().parent();
            let op="";
            //console.log(marque);
            $.ajax({
                type:'get',
                url:'{!! URL::to('findModele') !!}',
                data:{'id':marque},
                success:function(data){
                    //console.log('success');
                    //console.log(data);
                    //console.log(data.length);
                    op+='<option value="0" selected="true" disabled="true">Choisir le modele</option>';
                    for (let i = 0; i < data.length; i++) {
                    op+='<option value="'+data[i].id+'">'+data[i].nom_modele+'</option>';

                    div.find('#model_id').html("");
                    div.find('#model_id').append(op);
                    }

                },
                error:function(){
                    

                }
            });

        });

});
</script>
{{-- table mission et vehicule --}}
<script type="text/JavaScript">
    $(document).ready(function(){

        $(document).on('change','#vehicule_id',function(){
             //console.log("hmm its change");
            let vehicule=$(this).val();
            let div=$(this).parent().parent();
            let op="";
            //console.log(vehicule);
            $.ajax({
                type:'get',
                url:'{!! URL::to('findMission') !!}',
                data:{'id':vehicule},
                success:function(data){
                    //console.log('success');
                    //console.log(data);
                    //console.log(data.length);
                    op+='<option value="0" selected="true" disabled="true">Choisir la mission</option>';
                    for (let i = 0; i < data.length; i++) {
                    op+='<option value="'+data[i].id+'">'+data[i].type_mission+'</option>';

                    div.find('#mission_id').html("");
                    div.find('#mission_id').append(op);
                    }

                },
                error:function(){
                    

                }
            });

        });

});
</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script>
    let ENDPOINT = "{{ url('/') }}";
    let page = 1;
    infinteLoadMore(page);

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });

    function infinteLoadMore(page) {
        $.ajax({
                url: ENDPOINT + "/documents?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper").append(response);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }

</script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        // $('#reservationdate').datetimepicker({
        //   format: 'L'
        //  });
        //Date range picker
        // $('#reservation').daterangepicker()
        /*Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })*/
        /*Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });*/

    })

</script>

<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
    });

</script>
<!-- Auto chargement de l'etat du vehicule apres avoir selection ca plaque 
les donnees sont du meme table -->
<script type="text/JavaScript">
    $(document).ready(function(){

        $(document).on('change','.plaque',function(){
            let plak=$(this).val();
            let et=$(this).parent().parent();
            $.ajax({
                type:'get',
                url:'{!! URL::to('findEtat') !!}',
                data:{'id':plak},
                dataType:'json',
                success:function(data){
                    et.find('.etat').val(data.etat); 

                },
                error:function(){
                    

                }
            });

        });

});
</script>
