<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>@lang('admin.Copyright') &copy; @lang('admin.2020') <a href="#">@lang('admin.elkomy')</a>.</strong>
   @lang('admin.All rights reserved.')
    <div class="float-right d-none d-sm-inline-block">
        <b>@lang('admin.Version')</b> @lang('admin.1.1')
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url('/')}}/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('/')}}/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
@if(app()->getLocale()=='ar')
    <script src="{{url('/')}}/admin/dist/js/bootstrap-rtl.min.js"></script>
@endif
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{url('/')}}/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{url('/')}}/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{url('/')}}/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{url('/')}}/admin/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('/')}}/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{url('/')}}/admin/plugins/moment/moment.min.js"></script>
<script src="{{url('/')}}/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('/')}}/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{url('/')}}/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{url('/')}}/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/admin/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('/')}}/admin/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/')}}/admin/dist/js/demo.js"></script>
<script src="{{url('/')}}/admin/dist/js/noty.js"></script>
<script src="{{url('/')}}/admin/plugins/ckeditor/ckeditor.js"></script>
<script src="{{url('/')}}/admin/plugins/jquery-number-master/jquery.number.min.js"></script>
<script src="{{url('/')}}/admin/dist/js/custom.js"></script>

<script src="{{url('/')}}/admin/plugins/jasonday-printThis-f73ca19/printThis.js"></script>
@stack('js')

</body>
</html>
