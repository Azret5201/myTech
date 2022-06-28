<div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar navbar-light">
        <div class="container-xl">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./index.html">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        {!! \App\Enum\Icons::HOME() !!}
                    </span>
                        <span class="nav-link-title">
                      Fin com home
                    </span>
                    </a>
                </li>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('orders.index')}}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        {!! \App\Enum\Icons::HOME() !!}
                    </span>
                            <span class="nav-link-title">
                      Заказы
                    </span>
                        </a>
                    </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        {!! \App\Enum\Icons::STAR() !!}
                    </span>
                        <span class="nav-link-title">
                      Справочники
                   </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('cp.fin.credit_products.index')}}">
                            Кредитный продукт
                        </a>
                        <a class="dropdown-item" href="{{route('cp.fin.documents.index')}}">
                         Документы
                        </a>
                    </div>
                    </ul>

        </div>
    </div>
</div>
