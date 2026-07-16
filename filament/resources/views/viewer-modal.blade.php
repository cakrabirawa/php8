<div class="w-full bg-white dark:bg-gray-900 rounded-lg p-2 shadow-sm overflow-y-auto max-h-[calc(100vh-180px)]"
    x-data="{
        init() {
                setTimeout(() => {
                    this.renderReport();
                }, 400);
            },
            renderReport() {
                var elemenTarget = document.getElementById('viewerContent');
    
                if (!elemenTarget) return;
                if (typeof Stimulsoft === 'undefined') return;
                if (elemenTarget.innerHTML.trim() !== '') return;
    
                // 🟢 PERBAIKAN MUTLAK: String lisensi disatukan kembali dengan tanda '+' yang utuh dan dibersihkan dari spasi liar
                var licenseKey = '6vJhGtLLLz2GNviWmUTrhSqnOItdDwjBylQzQcAOiHnGiF9VxPUowBs2y/uoQrEsy15Pr1IeG4v2w513' +
                    'Fn8qqfJ0mDtH5u1Bgz2/YiQgrKH0TTR0mJgif+/hYq+eoMyoQDae6PEJo8t4+rc7pWFB2jxJGBcTk8mp' +
                    'uLHueLd8p7r32MAiu4TGeZc66SFspKqteEGtuIJmsJJdPm+UgUqzflCCut7PKj2tM6U9vj7YeSRhSBwE' +
                    'HbIcnMHuxEwwBUdlQW4yUbjDjSR2EVK/+83hr41VSnXdlch/rNXLBndif0e1cwwZHExN+tq8U+YpJcXG' +
                    'Kt8+uTkTCDBPvsYOukVWThU9AhOAxfyUuHGrJEsLylHs0bVYlk23hxAzDenR1Cp8vh6SWUoN3N7xheRA' +
                    'qYDmK2EpYpktcqv4vvv+Jgc/da6NZkEd9giWW9jE46Y4ewZUQ3OYmiZowSg8+P3W3RZ99a2xsaAQPfsX' +
                    'OAg2ESDHFt+O2bkvyvn46tlL5SQokjE4+iyrFPa+KjOHWg2wWlMDr/gOMtee25JMdonHFpTgwe1I0wUe' +
                    '8dT9fd+d36FS7T6Mghl87T+yZT63QkjnBYHFAlH6w71iVCt8qsXSQCYF0JDtdYR9Hk4wKar0Q527oBug' +
                    'tMJsNcMMXT9GVqMJMgDPVUxRmiU9AUQg98kpdZdS27Y=';
    
                // Membaca string enkripsi murni secara aman
                Stimulsoft.Base.StiLicense.loadFromString(licenseKey.replace(/\s/g, ''));
    
                if (typeof Stimulsoft.System !== 'undefined' && typeof Stimulsoft.System.StiObject !== 'undefined') {
                    window.addEventListener = (function(original) {
                        return function(type, listener, options) {
                            if (type === 'unload') {
                                type = 'pagehide';
                            }
                            return original.apply(this, [type, listener, options]);
                        };
                    })(window.addEventListener);
                }
    
                var options = new Stimulsoft.Viewer.StiViewerOptions();
                options.appearance.fullScreenMode = false;
                options.height = '650px';
    
                var viewer = new Stimulsoft.Viewer.StiViewer(options, 'StiViewer', false);
    
                viewer.onBeginProcessData = function(args, callback) {
                    if (typeof Stimulsoft.Helper !== 'undefined' && typeof Stimulsoft.Helper.process === 'function') {
                        Stimulsoft.Helper.process(args, callback);
                    } else {
                        if (typeof callback === 'function') callback();
                    }
                };
    
                var report = new Stimulsoft.Report.StiReport();
                report.loadFile('{{ asset('reports/ListVendor.mrt') }}');
    
                viewer.report = report;
                viewer.renderHtml('viewerContent');
    
                console.log('Stimulsoft Viewer sukses diluncurkan dengan lisensi komersial penuh!');
            }
    }">

    <div id="viewerContent" style="width: 100%; height: 650px;" wire:ignore></div>

</div>
