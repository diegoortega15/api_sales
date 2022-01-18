<template>
    <div class="container">

        <ul class="nav shadow-sm p-3 mb-5 bg-white rounded">
            <li class="nav-item">
                <router-link :to="{name: 'home'}" class="navbar-brand">Home</router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name: 'vendedor'}" class="navbar-brand">Vendedores</router-link>
            </li>
            <li>
                <router-link :to="{name: 'vendas'}" class="navbar-brand"> Vendas</router-link>
            </li>
        </ul>

    </div>
</template>

<script>
</script>