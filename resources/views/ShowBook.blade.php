<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
    <link rel="stylesheet" href="{{ asset('CSS/bookview.css') }}">
</head>
<body>
    @extends('Layout')
    {{-- Perlu logic embek saved baco pake ISBN --}}
    @section('PageContent')
    <div class="page-container">
        <div class="pdf-header">
            <a href="{{route('Detail Book', ['ISBN' => $book->ISBN])}}"><button id="back-button">Back</button></a>
            <span><span id="page-num"></span> / <span id="max-page-num"></span></span>
        </div>
        <div class="pdf-container">
            <button class="button" id="prev"></button>
            <canvas id="pdf-render"></canvas>
            <button class="button" id="next"></button>
        </div>
    </div>
    @endsection

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            const url = {!! json_encode($filePath) !!};
            console.log(url)
            const pdfjsLib = window['pdfjs-dist/build/pdf'];
            console.log(url)
            let pdfDoc = null;
            // pageNum buat ambil pageNum dari database
            let pageNum = {!! json_encode($page) !!};
            let pageIsRendering = false;
            let pageNumIsPending = null;

            const scale = 1.5;
            const canvas = document.querySelector('#pdf-render');
            const ctx = canvas.getContext('2d');

            pdfjsLib.getDocument(url).promise
            .then(pdfDoc_ => {
                pdfDoc = pdfDoc_;
                const storedPage = localStorage.getItem('lastPageRead');

                renderPage(pageNum);
                document.querySelector('#max-page-num').textContent = pdfDoc.numPages;
            })
            .catch(error => {
                console.error('Error loading PDF:', error);
            });

            // Render the page
            const renderPage = num => {
                pageIsRendering = true;
                pdfDoc.getPage(num).then(page => {
                    const viewport = page.getViewport({ scale });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const renderCtx = {
                        canvasContext: ctx,
                        viewport: viewport
                    };

                    page.render(renderCtx).promise.then(() => {
                        pageIsRendering = false;

                        if (pageNumIsPending !== null) {
                            renderPage(pageNumIsPending);
                            pageNumIsPending = null;
                        }
                    });
                });
                document.querySelector('#page-num').textContent = num;
            };


            // Show Prev Page
            const showPrevPage = () => {
                if (pageNum <= 1) {
                    return;
                }
                pageNum--;
                queueRenderPage(pageNum);
            };

            // Show Next Page
            const showNextPage = () => {
                if (pageNum >= pdfDoc.numPages) {
                    return;
                }
                pageNum++;
                console.log(pageNum)
                queueRenderPage(pageNum);
            };

            document.querySelector('#prev').addEventListener('click', showPrevPage);
            document.querySelector('#next').addEventListener('click', showNextPage);

        });

    </script>
</body>
</html>
