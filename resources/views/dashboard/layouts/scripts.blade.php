<!-- jquery -->
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">var plugin_path = '{{ asset('assets/js') }}/';</script>

<!-- chart -->
<script src="{{ asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
<script src="{{ asset('assets/js/toastr.js') }}"></script>

@yield('js')

<!-- validation -->
<script src="{{ asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

@if (app()->getLocale() == 'en')
    <script src="{{ asset('assets/js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
@else
    <script src="{{ asset('assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
@endif

<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>
