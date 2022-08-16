<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Dojo eCommerce</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url()?>">Settings</a>
          </li>
        </ul>

        <div class="logout me-3">
          <a href=""><?=$this->session->userdata('first_name')?></a>
        </div>

        <div class="logout me-3">
          <a href="<?=base_url()?>customers/cart">Shopping Cart (0)</a>
        </div>

        <div class="logout">
            <a href="<?=base_url();?>logout">Log Out</a>
        </div>
      </div>
    </div>
</nav>