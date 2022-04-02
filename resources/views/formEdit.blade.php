<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Admin Dynamic Form Edit</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{ asset('admin/assets/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('admin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" integrity="sha384-ejwKkLla8gPP8t2u0eQyL0Q/4ItcnyveF505U0NIobD/SMsNyXrLti6CWaD0L52l" crossorigin="anonymous">

        <!-- Template Main CSS File -->
        <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

        <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    </head>

    <body>

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">

                <li class="nav-item">
                    <a class="nav-link " data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    </ul>
                </li><!-- End Forms Nav -->
            </ul>

        </aside><!-- End Sidebar-->

        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Edit Dynamic Form</h1>
            </div>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if (session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
            @endif
            <section class="section">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Dynamic Form</h5>

                                <!-- Vertical Form -->
                                <form class="row g-3" method="POST" action="{{ route('formUpdate', ['formId' => $formEdit->id]) }}">
                                    @csrf
                                    <div class="col-12">
                                        <label for="label" class="form-label">Label</label>
                                        <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" id="label" value="{{ $formEdit->label }}">
                                        @error('label')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="sample" class="form-label">Sample</label>
                                        <input type="text" class="form-control @error('sample') is-invalid @enderror" name="sample" id="sample" value="{{ $formEdit->sample }}">
                                        @error('sample')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="field" class="form-label">HTML Field</label>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="field" id="text" value="text"  @checked(old('field', $formEdit->field))>
                                                <label class="form-check-label" for="text">
                                                    Text
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="field" id="number" value="number"  @checked(old('field', $formEdit->field))>
                                                <label class="form-check-label" for="number">
                                                    Number
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="field" id="select" value="select"  @checked(old('field', $formEdit->field))>
                                                <label class="form-check-label" for="select">
                                                    Select
                                                </label>
                                            </div>
                                            <button id="add">Add</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="comments" class="form-label">Comments</label>
                                        <input type="text" class="form-control" name="comments" id="comments" value="{{ $formEdit->comments }}">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <a class="btn btn-info" href="{{ route('formListTemplate') }}" role="button">Cancel</a>
                                    </div>
                                </form><!-- Vertical Form -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer">
            <div class="copyright">
                &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </footer><!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('admin/assets/js/main.js') }} "></script>

        <!-- Vendor JS Files -->
        <script src="{{ asset('admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
        <script src="{{ asset('admin/assets/vendor/chart.js/chart.min.js') }} "></script>
        <script src="{{ asset('admin/assets/vendor/echarts/echarts.min.js') }} "></script>
        <script src="{{ asset('admin/assets/vendor/quill/quill.min.js') }} "></script>
        <script src="{{ asset('admin/assets/vendor/simple-datatables/simple-datatables.js') }} "></script>
        <script src="{{ asset('admin/assets/vendor/tinymce/tinymce.min.js') }} "></script>
        <script src="{{ asset('admin/assets/vendor/php-email-form/validate.js') }} "></script>

        <script>
            $('#add').hide();
            window.setTimeout(function() {
                $(".alert-success").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 2000);

            $("#text").click(function() {
                $('#add').hide();
                $('#options').hide();
            });

            $("#number").click(function() {
                $('#add').hide();
                $('#options').hide();
            });

            $("#select").click(function() {
                $('#add').show();
            });

            $(function() {
                $('#add').on('click', function(e) {
                    e.preventDefault();
                    $('<div/>').addClass('col-12')
                        .html($('<input type="textbox" id="options" name="options[]" placeholder="Option to add custom values" />').addClass('form-control'))
                        .append($('<button/>').addClass('remove').text('Remove'))
                        .insertBefore(this);
                });
                $(document).on('click', 'button.remove', function(e) {
                    e.preventDefault();
                    $(this).closest('div.col-12').remove();
                });
            });
        </script>

    </body>

    </html>
</x-app-layout>