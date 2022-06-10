@push('style')
<style>
    .colored-toast.swal2-icon-success {
        background-color: #a5dc86 !important;
    }

    .colored-toast.swal2-icon-error {
        background-color: #f27474 !important;
    }

    .colored-toast.swal2-icon-warning {
        background-color: #f8bb86 !important;
    }

    .colored-toast.swal2-icon-info {
        background-color: #3fc3ee !important;
    }

    .colored-toast.swal2-icon-question {
        background-color: #87adbd !important;
    }

    .colored-toast .swal2-title {
        color: white;
    }

    .colored-toast .swal2-close {
        color: white;
    }

    .colored-toast .swal2-html-container {
        color: white;
    }
</style>
@endpush
@push('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        customClass: {
            popup: 'colored-toast'
        },
        showConfirmButton: false,
        // timer: 3500,
        timerProgressBar: true
    })
    @if(session()->has('successMessage'))
        Toast.fire("Success", "{{ session()->get('successMessage') }}", "success");
    @endif
    @if(session()->has('alertMessage'))
        Toast.fire("Alert!", "{{ session()->get('alertMessage') }}", "warning");
    @endif
    @if(session()->has('dangerMessage'))
        Toast.fire("Oops!", "{{ session()->get('dangerMessage') }}", "error");
    @endif
    @if(session()->has('infoMessage'))
        Toast.fire("Alert!", "{{ session()->get('infoMessage') }}", "info");
    @endif
</script>
@endpush

{{-- //vaidation errors --}}
@if($errors->any())
<div style="position: fixed; top: 60px; right: 20px; z-index: 99">
    @foreach($errors->all() as $error)
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
        <div class="toast-header">
            <strong class="mr-auto text-warning">Alert!</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ $error }}
        </div>
    </div>
    @endforeach
</div>
@endif