<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">

                <p class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl ml-4 mt-6">
                    E-Commerce Name
                </p>

                <p class="text-xl font-bold">Woo hoo! Your order is on its way. Your order details can be found below.
                </p>


                <p>TRACK YOUR ORDER [link]</p>

                <div class="mb-2 text-2xl flex justify-start">
                    ORDER SUMMARY:
                </div>
                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">

                <div class="mb-3">
                    <p class="my-2">Order ID: {{ $order->id }}</p>
                    <p class="my-2">Order Date: {{ $order->created_at }}</p>
                    <p class="my-2">Order Total: ${{ $order->total_price }}</p>

                    <p class="my-2"> SHIPPING ADDRESS: {{ $order->state }}, {{ $order->city }},
                        {{ $order->address1 }}</p>
                </div>

                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="my-2 text-xl flex justify-start">
                    Products:
                </div>
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price (Total)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                            <tr>
                                <td>{{ $product['name'] }}</td>
                                <td>{{ $product['qty'] }}</td>
                                <td>{{ $product['total_price'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>

</html>
