<footer class="footer">

    <div class="container-fluid d-flex justify-content-between">

      <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © {{ date('Y') }}</span>

    </div>

  </footer>

  <!-- partial -->

</div>

<!-- main-panel ends -->

</div>

<!-- page-body-wrapper ends -->

</div>

<!-- container-scroller -->

<!-- plugins:js -->

<link rel="stylesheet" href=" {{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>

<!-- endinject -->

<!-- Plugin js for this page -->

<script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>

<!-- End plugin js for this page -->

<!-- inject:js -->

<script src="{{ asset('assets/js/off-canvas.js') }}"></script>

<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>

<script src="{{ asset('assets/js/misc.js') }}"></script>

<!-- endinject -->

<!-- Custom js for this page -->

<script src="{{ asset('assets/js/chart.js') }}"></script>

<!-- End custom js for this page -->
<!-- 

<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/buttons.dataTables.min.css') }}"> -->





<script>

    tinymce.init({

    selector: 'textarea#example',

    height: 500,

    plugins: [

        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',

        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',

        'insertdatetime', 'media', 'table', 'help', 'wordcount'

    ],

    toolbar: 'undo redo | blocks | ' +

    'bold italic backcolor | alignleft aligncenter ' +

    'alignright alignjustify | bullist numlist outdent indent | ' +

    'removeformat | help',

    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'

    });

</script>





 <script>

    $(document).ready(function(){

        $('#example').dataTable({

            pageLength: 100,

            searching: true

        });
        $('#extable_dashboard').DataTable({

            "pageLength": 25,
            responsive: true
            });

         $('#extable').DataTable({

            "pageLength": 25,
            responsive: true
            });

         $('#extable2').DataTable({

            "pageLength": 25,
            responsive: true
            });


        $('#extable3').DataTable({

        "pageLength": 50,
        responsive: true
        });

        $('#extable5').DataTable({

        "pageLength": 25,
        responsive: true,
         dom: 'Bfrtip',
      buttons: [ 
      'excel',
      {
      extend: 'pdfHtml5',
      customize: function ( doc ) {
      doc.content.splice( 1, 0, {
      margin: [ 0, 0, 0, 12 ],
      alignment: 'center',
 image: 'data:image/png;base64,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'
                            } );
                }
            
                }
               ],
        });
        $('#example2').dataTable({

            pageLength: 100,

            autoWidth: false,

            searching: true,

            responsive: true

        });



        $('#itemlist').dataTable({

            pageLength: 100,

            autoWidth: false,

            searching: true

        });



        $('#auctionlist').dataTable({

            pageLength: 50,

            autoWidth: false,

            searching: true

        });

       



        $('#exampleyu').dataTable({

            responsive: true

        });

    });





    </script>



<script>

    $(document).ready(function(){

        $("#limitation").change(function(){

            var lim = $("#limitation").val();



            if(lim=='Other')

            {

                $("#xother").show();

            }

            else

            {

                $("#xother").hide();

            }

        });

    });



    $(document).ready(function(){

        new DataTable('#example', {

        

            responsive: true,

            "info":     false,

            

        });

  

    });

    $(function() {

        $("#curr").on("change",function() {

            var curr   = this.value;

            var prefix = curr=="usd"; // or ["usd","yen",...].indexOf(curr); for more

            var sign   = curr=="usd"?"":"";

            $(".price").each(function(){

            $(this).text(

                (prefix?sign:"")   +

                $(this).data(curr) +

                (prefix?"":sign)

            );  

            })

        }).change();

    });



</script>





<!-- <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>

<script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>

<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script> -->

<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->

<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<!-- endinject -->


<!-- Custom js for this page -->
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>

<!-- End custom js for this page -->

<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/responsive.bootstrap5.min.js') }}"></script>

<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.3.0/js/dataTables.rowGroup.min.js"></script>


<script>
  $(document).ready(function () {
    
    $('#extable3').DataTable(
        responsive: true,
    );
    
});
</script>

</body>

</html>

