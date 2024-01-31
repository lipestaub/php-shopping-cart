<?php
    class Cart {
        public function add(Product $product) {
            $productInCart = $this->getProductInCart($product->getId());

            if ($productInCart != []) {
                $quantity = $productInCart->getQuantity() + $product->getQuantity();
                $_SESSION['cart']['products'][$product->getId()]->setQuantity($quantity);
            }
            else {
                $this->setProductInCart($product);
            }

            $this->updateTotal();
        }

        public function remove(int $productId) {
            unset($_SESSION['cart']['products'][$productId]);
            $this->updateTotal();
        }

        public function getProductInCart(int $productId) {
            return $_SESSION['cart']['products'][$productId] ?? [];
        }

        public function getProductsInCart() {
            return $_SESSION['cart']['products'] ?? [];
        }

        private function setProductInCart(Product $product) {
            if(!isset($_SESSION['cart']['products'])) {
                $_SESSION['cart']['products'] = [];
            }

            $_SESSION['cart']['products'][$product->getId()] = $product;
        }

        public function getTotal() {
            return $_SESSION['cart']['total'] ?? 0;
        }

        private function updateTotal() {
            $_SESSION['cart']['total'] = 0;
            
            foreach ($this->getProductsInCart() as $product) {
                $_SESSION['cart']['total'] += $product->getPrice() * $product->getQuantity();
            }
        }
    }
?>