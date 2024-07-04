<aside class="sidebar navbar navbar-expand-lg bg-dark d-flex flex-column gap-4 align-content-center mx-2 my-2">
    <h5 class="navbar-brand text-white">Toko Online Kita</h5>
    <hr style="color: white; font-weight: 800;">
    <div class="collapse navbar-collapse flex-grow-0" id="navbarNavDropdown">
        <ul class="navbar-nav flex-column gap-3 px-2">
            <li class="navbar-item">
                <a href="{{ route('admin.dashboard') }}" class="text-white nav-link">
                    <div class="d-flex gap-3">
                        <span class="material-icons">dashboard</span>
                        <p class="m-0 p-0">Dashboard</p>
                    </div>
                </a>
            </li>
            <li class="navbar-item">
                <a href="{{ route('page.products.index') }}" class="text-white nav-link">
                    <div class="d-flex gap-3">
                        <span class="material-icons">inventory</span>
                        <p class="m-0 p-0">Product</p>
                    </div>
                </a>
            </li>
            
            </li>
            <li class="navbar-item">
                <a href="{{ route('page.transactions.history') }}" class="text-white nav-link">
                    <div class="d-flex gap-3">
                        <span class="material-icons">assignment</span>
                        <p class="m-0 p-0">Orders</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</aside>