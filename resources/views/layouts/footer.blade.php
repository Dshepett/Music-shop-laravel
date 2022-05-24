<footer class="py-3 my-4">

    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">Главная</a></li>
        <li><a href="{{route('categories.index')}}" class="nav-link px-2 link-dark">Категории</a></li>
        <li><a href="{{route('products.index')}}" class="nav-link px-2 link-dark">Товары</a></li>
        @auth
            <li><a href="{{route('orders.index')}}" class="nav-link px-2 link-dark">Заказы</a></li>
        @endauth
    </ul>

    <p class="text-center text-muted">© 2022 Music Shop, Inc</p>
</footer>

