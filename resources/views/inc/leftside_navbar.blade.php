<div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky" style="text-align:left;">
          @if(auth()->user()->hasAnyRole(['admin','manager']))
          <ul class="nav flex-column" >
            <li class="nav-item">
              <a class="nav-link active" href="/dashboard">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>            
            <li class="nav-item">
              <a class="nav-link" href="/posts/item">
                <span data-feather="shopping-cart"></span>
                Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/user">
                <span data-feather="users"></span>
                Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/posts/vendor">
                <span data-feather="users"></span>
                Vendors
              </a>
            </li>
          </ul>
         @endif
          @if(!auth()->user()->hasRole('manager'))
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Entry Tables</span><!--Should be accessible to officers and admin only-->
            <a class="d-flex align-items-center text-muted" href="#">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="/vendor/create">
                <span data-feather="plus"></span>
                 Vendor entry
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/item/create">
                <span data-feather="plus"></span>
                Item entry
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/purchase/create">
                <span data-feather="plus"></span>
                Purchase entry
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/sales/create">
                <span data-feather="plus"></span>
                Sales entry
              </a>
            </li>
          </ul>
         @endif
        </div>
      </nav>

      
  

  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>
