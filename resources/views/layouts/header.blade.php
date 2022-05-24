<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                @auth
                    <li><a href="/" class="nav-link px-2 link-secondary">Главная</a></li>
                    <li><a href="{{route('categories.index')}}" class="nav-link px-2 link-dark">Категории</a></li>
                    <li><a href="{{route('products.index')}}" class="nav-link px-2 link-dark">Товары</a></li>
                    <li><a href="{{route('orders.index')}}" class="nav-link px-2 link-dark">Заказы</a></li>
                @endauth
                @guest
                    <li><a href="{{route('login')}}" class="nav-link px-2 link-dark">Войти</a></li>
                    <li><a href="{{route('register')}}" class="nav-link px-2 link-dark">Зарегистрироваться</a></li>
                @endguest
            </ul>

            @auth
                <div class="dropdown text-end">
                    <a href="#"
                       class="d-block link-dark text-decoration-none dropdown-toggle"
                       id="dropdownUser1"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}
                        <img
                            src="https://www.digdes.com/blog/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png"
                            alt="mdo" class="rounded-circle" width="32" height="32">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="{{route('users.show', auth()->user())}}">Профиль</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Выйти</a></li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</header>

