@include('head')
<body>
    <div class="container">
        <h1 class="text-center p-3">Products project</h1>
        <main>
            @foreach ($products as $product)
                <h1>{{$product->name}}</h1>
            @endforeach
        </main>
    </div>
</body>

<script>
</script>
