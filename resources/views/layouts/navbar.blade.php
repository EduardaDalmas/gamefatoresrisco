<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <div class="container-fluid">
        <div class="w-75"></div>
        <div class="w-25 d-flex justify-content-end">
            <form class="d-flex" method="POST" action="{{ route('logout') }}">
            @csrf
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>