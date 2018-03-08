</main>
<!-- END Main Container -->
<!-- Footer -->
<footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
    <div class="pull-right">
        Skapad <i class="fa fa-heart text-city"></i> av <a class="font-w600" href="{{ env('APP_AUTHOR_URL') }}" target="_blank">{{ env('APP_AUTHOR') }}</a>
    </div>
    <div class="pull-left">
        <a class="font-w600" href="{{ env('APP_URL') }}" target="_blank">{{ env('APP_NAME') }}</a> &copy; <span class="js-year-copy"></span>
    </div>
</footer>
<!-- END Footer -->
</div>
<!-- END Page Container -->

<!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
<script src="{{ asset('assets/js/oneui.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<!-- Page JS Plugins + Page JS Code -->
@yield('scripts')
</body>
</html>
