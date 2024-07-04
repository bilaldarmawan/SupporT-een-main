<style>
    
.navbar {
    background-color: #f8f9fa;
    border-bottom: 2px solid #eaeaea;
}

.navbar-brand {
    font-weight: bold;
    color: #343a40;
    font-size: 1.5rem;
}

.navbar-nav .nav-link {
    color: #343a40;
    margin-right: 1rem;
    font-size: 1rem;
}

.navbar-nav .nav-link:hover {
    color: #007bff;
}

.navbar-nav .nav-item.active .nav-link {
    color: #007bff;
}

.navbar-toggler {
    border: none;
}

.navbar-toggler-icon {
    color: #343a40;
}

.btn-outline-secondary {
    color: #343a40;
    border-color: #343a40;
}

.btn-outline-secondary:hover {
    color: #fff;
    background-color: #343a40;
    border-color: #343a40;
}

  </style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#">HOME CLEAN</a>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/jasa">Jasa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/history">History</a>
        </li>
      </ul>
      <a href="/cart" class="btn btn-outline-secondary">
        <i class="fa-solid fa-bag-shopping"></i>
      </a>
    </div>
  </div>
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-outline-secondary">Logout</button>
  </form>
</nav>
