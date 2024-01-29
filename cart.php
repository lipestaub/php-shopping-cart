<?php
    require_once __DIR__ . '/classes/Cart.php';
    require_once __DIR__ . '/classes/Product.php';

    session_start();

    if(isset($_GET['productId'])) {
        $productId = $_GET['productId'];

        $cart = new Cart();
        $cart->remove($productId);
    }

    $cart = new Cart();
    $products = $cart->getCart();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="/php-carrinho/index.php">Início</a></li>
            <li><a href="/php-carrinho/cart.php">Carrinho</a></li>
        </ul>
    </nav>
    <table>
        <tr>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
        <?php
            foreach($products as $product) {
        ?>
                <tr>
                    <td><?php echo $product->getDescription(); ?></td>
                    <td>R$ <?php echo number_format($product->getPrice(), 2, ',', ''); ?></td>
                    <td><?php echo $product->getQuantity(); ?></td>
                    <td><?php echo number_format(($product->getPrice() * $product->getQuantity()), 2, ',', ''); ?></td>
                    <td><a href="?productId=<?php echo $product->getId(); ?>">Remover</a></td>
                </tr>
        <?php
            }
        ?>
    </table>
    <br>
    <span>Valor Total: R$ <?php echo number_format($cart->getTotal(), 2, ',', ''); ?></span>
</body>
</html>