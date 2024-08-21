<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
        {{-- tambahkan onsubmit dan action agar tidak reload --}}
        <form onSubmit="JavaScript:submitHandler()" action="javascript:void(0)" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" class="form-control">
                    <div class="form-group">
                        <label for="temperatur"><b>Temperatur</b></label>
                        <input type="number" name="temperatur" id="temperatur" class="form-control" required autofocus>
                        <span class="text-danger" id="error-temperatur"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="tds"><b>TDS</b></label>
                        <input type="number" name="tds" id="tds" class="form-control" required autofocus>
                        <span class="text-danger" id="error-tds"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="tss"><b>TSS</b></label>
                        <input type="number" name="tss" id="tss" class="form-control" required autofocus>
                        <span class="text-danger" id="error-tss"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ph"><b>pH</b></label>
                        <input type="number" name="ph" id="ph" class="form-control" required autofocus>
                        <span class="text-danger" id="error-ph"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="bod"><b>BOD</b></label>
                        <input type="number" name="bod" id="bod" class="form-control" required autofocus>
                        <span class="text-danger" id="error-bod"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="cod"><b>COD</b></label>
                        <input type="number" name="cod" id="cod" class="form-control" required autofocus>
                        <span class="text-danger" id="error-cod"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="do"><b>DO</b></label>
                        <input type="number" name="do" id="do" class="form-control" required autofocus>
                        <span class="text-danger" id="error-do"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="curah_hujan"><b>Curah Hujan</b></label>
                        <input type="number" name="curah_hujan" id="curah_hujan" class="form-control" required autofocus>
                        <span class="text-danger" id="error-curah-hujan"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="kelas"><b>Kelas</b></label>
                        <input type="number" name="kelas" id="kelas" class="form-control" required autofocus>
                        <span class="text-danger" id="error-kelas"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-flat btn-success" id="saveBtn"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-sm btn-flat btn-danger close-btn" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                </div>
            </div>
        </form>
    </div>
</div>