<?php
    require_once __DIR__ . '/classes/Cart.php';
    require_once __DIR__ . '/classes/Product.php';

    session_start();
    
    $products = [
        0 => ['id' => 1, 'description' => 'Geladeira', 'price' => 1499.99, 'quantity' => 1],
        1 => ['id' => 2, 'description' => 'Mouse', 'price' => 39.99, 'quantity' => 1],
        2 => ['id' => 3, 'description' => 'Teclado', 'price' => 49.99, 'quantity' => 1],
        3 => ['id' => 4, 'description' => 'Monitor', 'price' => 499.99, 'quantity' => 1]
    ];

    if(isset($_GET['productId'])) {
        $productId = $_GET['productId'];

        $productData = $products[$productId - 1];

        $product = new Product();
        $product->setId($productData['id']);
        $product->setDescription($productData['description']);
        $product->setPrice($productData['price']);
        $product->setQuantity($productData['quantity']);

        $cart = new Cart();
        $cart->add($product);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="/index.php">Início</a></li>
            <li><a href="/cart.php">Carrinho</a></li>
        </ul>
    </nav>
    <table>
        <tr>
            <th>Descrição</th>
            <th>Preço</th>
            <th></th>
        </tr>
        <?php
            foreach($products as $product) {
        ?>
                <tr>
                    <td><?php echo $product['description']; ?></td>
                    <td>R$ <?php echo number_format($product['price'], 2, ',', ''); ?></td>
                    <td><a href="?productId=<?php echo $product['id']; ?>">Adicionar ao carrinho</a></td>
                </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>