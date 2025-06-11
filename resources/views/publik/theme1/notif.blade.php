@if ($errors->any())
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
        <div id="errorToast" class="toast auto-toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <div class="toast-progress position-absolute bottom-0 start-0 bg-light" style="height: 4px; width: 100%; animation: shrink linear forwards;"></div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Tutup"></button>
            </div>
        </div>
    </div>
@endif
@if (session('message'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
        <div id="successToast" class="toast auto-toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('message') }}
                    <div class="toast-progress position-absolute bottom-0 start-0 bg-light" style="height: 4px; width: 100%; animation: shrink linear forwards;"></div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Tutup"></button>
            </div>
        </div>
    </div>
@endif