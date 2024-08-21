<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel CRUD Kualitas Air</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.3/af-2.3.7/b-2.1.1/cr-1.5.5/date-1.1.1/fc-4.0.1/fh-3.2.1/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/sr-1.0.1/datatables.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>
    <div class="container-fluid">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Kualitas Air</h1>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <button onclick="addForm()" class="btn btn-success btn-xs btn-flat">
                                <i class="fa fa-plus-circle"></i>
                                Tambah
                                <br>
                            </button>
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-stiped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="5%">Temperatur</th>
                                        <th width="2%">TDS</th>
                                        <th width="2%">TSS</th>
                                        <th width="2%">pH</th>
                                        <th width="2%">BOD</th>
                                        <th width="2%">COD</th>
                                        <th width="2%">DO</th>
                                        <th width="8%">Curah Hujan</th>
                                        <th width="5%">Kelas</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @includeIf('kualitas_air.form')
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.3/af-2.3.7/b-2.1.1/cr-1.5.5/date-1.1.1/fc-4.0.1/fh-3.2.1/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/sr-1.0.1/datatables.min.js">
    </script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

        var table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            lengthChange: true,
            processing: true,
            serverSide: true,
            dom: 'lfrtip',
            ajax: "{{ route('kualitas-air.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'temperatur',
                    name: 'temperatur'
                },
                {
                    data: 'tds',
                    name: 'tds'
                },
                {
                    data: 'tss',
                    name: 'tss'
                },
                {
                    data: 'ph',
                    name: 'ph'
                },
                {
                    data: 'bod',
                    name: 'bod'
                },
                {
                    data: 'cod',
                    name: 'cod'
                },
                {
                    data: 'do',
                    name: 'do'
                },
                {
                    data: 'curah_hujan',
                    name: 'curah_hujan'
                },
                {
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        
        $('.close-btn').click(function(e) {
            $('.modal').modal('hide')
        });

        $('#saveBtn').click(function(e) {
            var formdata = $("#modal-form form").serializeArray();
            var data = {};
            $(formdata).each(function(index, obj) {
                data[obj.name] = obj.value;
            });
            if (validation(data)) {
                $.ajax({
                    data: $('#modal-form form').serialize(),
                    url: "{{ route('kualitas-air.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#modal-form').modal('hide');
                        $('.table').DataTable().draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            }

        });

        $('body').on('click', '.editKualitasAir', function() {
            var id = $(this).data('id');
            $.get("{{ url('kualitas-air/') }}" + '/' + id + '/edit', function(data) {
                $('.modal-title').text('Edit Data Kualitas Air');
                $('#modal-form').modal('show');
                $('#saveBtn').show();
                $("input").prop('disabled', false);
                $('#id').val(data.id);
                $('#temperatur').val(data.temperatur);
                $('#tds').val(data.tds);
                $('#tss').val(data.tss);
                $('#ph').val(data.ph);
                $('#bod').val(data.bod);
                $('#cod').val(data.cod);
                $('#do').val(data.do);
                $('#curah_hujan').val(data.curah_hujan);
                $('#kelas').val(data.kelas);
            })
        });

        $('body').on('click', '.viewKualitasAir', function() {
            var id = $(this).data('id');
            $.get("{{ url('kualitas-air') }}" + '/' + id + '/edit', function(data) {
                $('.modal-title').text('View Data Kualitas Air');
                $('#modal-form').modal('show');
                $('#saveBtn').hide();
                $("input").prop('disabled', true);
                $('#id').val(data.id);
                $('#temperatur').val(data.temperatur);
                $('#tds').val(data.tds);
                $('#tss').val(data.tss);
                $('#ph').val(data.ph);
                $('#bod').val(data.bod);
                $('#cod').val(data.cod);
                $('#do').val(data.do);
                $('#curah_hujan').val(data.curah_hujan);
                $('#kelas').val(data.kelas);
            })
        });

        $('body').on('click', '.deleteKualitasAir', function() {
            var id = $(this).data("id");
            if (confirm("Are you sure want to delete?") == true) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('kualitas-air.index') }}" + '/' + id,
                    success: function(data) {
                        $('.table').DataTable().draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        function addForm() {
            $("#modal-form").modal('show');
            $('#saveBtn').show();
            $("input").prop('disabled', false);
            $('#id').val('');
            $('.modal-title').text('Tambah Data Kualitas Air');
            $('#modal-form form')[0].reset();
            $('#modal-form [name=name]').focus();
        }

        function validation(data) {
            let formIsValid = true;
            $('span[id^="error"]').text('');
            if (!data.temperatur) {
                formIsValid = false;
                $("#error-temperatur").text('The Temperatur field is required.')
            } else if (!data.tds) {
                formIsValid = false;
                $("#error-tds").text('The TDS field is required.')
            } else if (!data.tss) {
                formIsValid = false;
                $("#error-tss").text('The TSS field is required.')
            } else if (!data.ph) {
                formIsValid = false;
                $("#error-ph").text('The pH field is required.')
            } else if (!data.bod) {
                formIsValid = false;
                $("#error-bod").text('The BOD field is required.')
            } else if (!data.cod) {
                formIsValid = false;
                $("#error-cod").text('The COD field is required.')
            } else if (!data.do) {
                formIsValid = false;
                $("#error-do").text('The DO field is required.')
            } else if (!data.curah_hujan) {
                formIsValid = false;
                $("#error-curah-hujan").text('The Curah Hujan field is required.')
            } else if (!data.kelas) {
                formIsValid = false;
                $("#error-kelas").text('The Kelas field is required.')
            }

            return formIsValid;
        }

        function submitHandler() {
            $('#saveBtn').click();
        }
    </script>
</body>

</html>