@extends('index.index')

@section('app-title', 'Main Menu (Preview)')

@section('app-content')
    <div class="modal fade " id="logout-confirmation" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5 ">Logout Confirmation</h1>
                    <button type="button" class="btn-close " data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body ">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-danger ">Confirm</button>
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid ">
        <div class="alert alert-info ">
            <h1>Preview Mode</h1>
            <p>Click <a href="{{ route('index') }}">here</a> to come back</p>
            <p>Simplicity... Is everything!</p>
            <h2>Note:</h2>
            <p>No Button Works for now...</p>
        </div>
    </div>
    <div class="container bg-white p-4 rounded-3">
        <header>
            <div class="d-flex justify-content-between ">
                <div>
                    <div class="fs-1 fw-bold ">Hello <span class="text-primary ">Admin!</span></div>
                </div>
                <div class="d-flex flex-column ">
                    <div class="text-end m-0 ">System Time</div>
                    <div class="fs-1 fw-bold m-0 " id="current-time"></div>
                </div>
            </div>
        </header>

        <main class="d-flex flex-column justify-content-evenly align-items-center gap-4 mt-5">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.cashier.index') }}" class="btn btn-primary px-5 py-3 fs-3 fw-bold  ">Manage User</a>
                <a href="{{ route('admin.item.index') }}" class="btn btn-primary px-5 py-3 fs-3 fw-bold  ">Manage Item</a>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.transaction_history') }}" class="btn btn-primary px-5 py-3 fs-3 fw-bold  ">Transaction History</a>
                <a href="{{ route('admin.log') }}" class="btn btn-primary px-5 py-3 fs-3 fw-bold  ">Logs</a>
            </div>
            <button type="button" class="btn btn-danger px-5 py-3 fs-3 fw-bold " data-bs-toggle="modal" data-bs-target="#logout-confirmation">Logout</button>
        </main>
    </div>
    <script>
        function updateTime() {
            const currentTime = new Date();
            const year = currentTime.getFullYear();
            const month = ('0' + (currentTime.getMonth() + 1)).slice(-2); // Months are zero-based
            const date = ('0' + currentTime.getDate()).slice(-2);
            const hours = ('0' + currentTime.getHours()).slice(-2);
            const minutes = ('0' + currentTime.getMinutes()).slice(-2);
            const seconds = ('0' + currentTime.getSeconds()).slice(-2);

            const formattedTime = year + '-' + month + '-' + date + ' ' + hours + ':' + minutes + ':' + seconds;

            document.getElementById('current-time').textContent = formattedTime;
        }

        // Update time every second
        setInterval(updateTime, 1000);

        // Call updateTime once to display initial time
        updateTime();
    </script>
@endsection

