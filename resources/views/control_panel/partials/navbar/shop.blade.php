<div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar navbar-light">
        <div class="container-xl">
            <ul class="navbar-nav">
                <li class="nav-item d-flex">
                    <a class="nav-link" href="./index.html">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        {!! \App\Enum\Icons::SHOP() !!}
                    </span>
                        <span class="nav-link-title">
                      Shop home
                    </span>
                    </a>
                </li>
                <li class="nav-item d-flex">
                    <a class="nav-link" href="{{ route('listProducts') }}">
                        <span class="nav-link-title ps-3">
                            Assortments
                        </span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
