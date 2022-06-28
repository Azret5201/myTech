<div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar navbar-light">
        <div class="container-xl">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cp.admin.home') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        {!! \App\Enum\Icons::HOME() !!}
                    </span>
                        <span class="nav-link-title">
                      Admin home
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
                        <a class="dropdown-item" href="{{route('cp.admin.brand')}}">
                            Брэнды
                        </a>
                        <a class="dropdown-item" href="{{route('cp.admin.category')}}">
                            Категории
                        </a>
                        <a class="dropdown-item" href="{{route('cp.admin.product')}}">
                            Продукты
                        </a>
                        <a class="dropdown-item" href="{{route('cp.admin.page')}}">
                            Статические страницы
                        </a>

                    </div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        {!! \App\Enum\Icons::SETTINGS() !!}
                    </span>
                        <span class="nav-link-title">
                      Настройки
                    </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('cp.admin.product_blocks.index')}}">
                            Главная страница
                        </a>
                    </div>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cp.admin.shop') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        {!! \App\Enum\Icons::SHOP() !!}
                    </span>
                        <span class="nav-link-title">
                      Магазины
                    </span>
                    </a>
                </li>
                <li style="margin-top:6px">
                    </a>
                    <a class="nav-link " href="{{route('cp.admin.finance_company.index')}}">
                         <span class="nav-link-icon d-md-none d-lg-inline-block">
                        {!! \App\Enum\Icons::BANK() !!}
                    </span>
                        <span class="nav-link-title">
                      Финансовые компании
                    </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
