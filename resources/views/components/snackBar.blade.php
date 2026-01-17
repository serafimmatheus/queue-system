@if (session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded fixed top-0 right-0 m-4 snackbar" role="alert">
        {{ session('success') }}
        <button class="close-btn" onclick="this.parentElement.style.display = 'none';">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

@if (session()->has('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded fixed top-0 right-0 m-4 snackbar" role="alert">
        {{ session('error') }}
        <button class="close-btn" onclick="this.parentElement.style.display = 'none';">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

<script>
    setTimeout(function() {
        document.querySelector('.snackbar').style.display = 'none';
    }, 3000);
</script>