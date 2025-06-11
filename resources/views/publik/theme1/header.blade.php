<div class="container">
  <header class="border-bottom lh-1 py-3"> 
    <div class="row flex-nowrap justify-content-between align-items-center"> 
      <div class="col-4 pt-1"> 
        
      </div> 
      <div class="col-4 text-center">
        <h1><p class="blog-header-logo  text-body-emphasis">Frontend</p></h1>
      </div> 
      <div class="col-4 d-flex justify-content-end align-items-center">  
        

      </div> 
    </div> 
  </header>
  <div class="nav-scroller py-1 mb-3 border-bottom"> 
    <button onclick="logout()" class="btn btn-outline-secondary mb-3">Logout</button>
    <!-- @auth
      <form id="logout-form" action="{{ route('default.logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-secondary">Logout</button>
      </form>
    @else
      <a href="{{ url('/default/login') }}" class="btn btn-sm btn-outline-secondary">Login</a>
      @if (Route::has('register'))
        <a href="{{ route('register') }}" class="btn btn-sm btn-outline-secondary">Register</a>
      @endif
    @endauth -->
  </div>
</div>