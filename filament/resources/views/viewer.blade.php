<!DOCTYPE html>
<html>

<head>
    <title>Stimulsoft Viewer - Laravel 13</title>

    <!-- 🟢 Memuat berkas library JavaScript inti Stimulsoft langsung melalui jalur CDN / Vendor -->
    <script src="{{ asset('stimulsoft/stimulsoft.reports.engine.pack.js') }}" type="text/javascript"></script>
    <script src="{{ asset('stimulsoft/stimulsoft.viewer.pack.js') }}" type="text/javascript"></script>
    <script src="{{ asset('stimulsoft/stimulsoft.reports.export.pack.js') }}" type="text/javascript"></script>
</head>

<body onload="initViewer()">

    <!-- 🟢 Tempat penampung (container) komponen penampil laporan visual -->
    <div id="viewerContent"></div>

    <script type="text/javascript">
        function initViewer() {
            // 1. Konfigurasi standar penampil laporan Stimulsoft.JS
            var options = new Stimulsoft.Viewer.StiViewerOptions();
            options.appearance.fullScreenMode = false;
            options.height = "600px";

            // 2. Membuat objek penampil laporan di dalam elemen 'viewerContent'
            var viewer = new Stimulsoft.Viewer.StiViewer(options, "StiViewer", false);

            // 3. Menghubungkan proses request data Ajax ke rute /handler Laravel Anda
            viewer.onBeginProcessData = function(args, callback) {
                Stimulsoft.Helper.process(args, callback);
            };

            // 4. Membuat objek template laporan baru
            var report = new Stimulsoft.Report.StiReport();

            // 5. Memuat berkas desain laporan Anda (.mrt) dari direktori public/reports/
            report.loadFile("reports/ListVendor.mrt");

            // 6. Hubungkan objek template ke dalam komponen penampil visual dan render
            viewer.report = report;
            viewer.renderHtml("viewerContent");
        }
    </script>
</body>

</html>
