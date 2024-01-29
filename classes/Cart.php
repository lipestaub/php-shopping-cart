<?php
    class Cart {
        public function add(Product $product) {
            $productInCart = false;
            $this->setTotal($product);

            if(isset($_SESSION['cart']['products'])) {
                if(count($this->getCart()) > 0) {
                    foreach($this->getCart() as $productInCart) {
                        if($productInCart->getId() === $product->getId()) {
                            $quantity = $productInCart->getQuantity() + $product->getQuantity();
                            $productInCart->setQuantity($quantity);
    
                            $productInCart = true;
                            break;
                        }
                    }
                }
            }

            if(!$productInCart) {
                $this->setProductsInCart($product);
            }
        }

        public function remove(int $id) {
            if (isset($_SESSION['cart']['products'])) {
                foreach($this->getCart() as $key=>$product) {
                    if($product->getId() === $id) {
                        unset($_SESSION['cart']['products'][$key]);
                        $_SESSION['cart']['products'] -= $product->getPrice() * $product->getQuantity();
                    }
                }
            }
        }

        public function getCart() {
            return $_SESSION['cart']['products'] ?? [];
        }

        private function setProductsInCart(Product $product) {
            if(!isset($_SESSION['cart']['products'])) {
                $_SESSION['cart']['products'] = [];
            }
            var_dump('aqui');
            array_push($_SESSION['cart']['products'], $product);
        }

        public function getTotal() {
            return $_SESSION['cart']['total'] ?? 0;
        }

        private function setTotal(Product $product) {
            if (!isset($_SESSION['cart']['total'])) {
                $_SESSION['cart']['total'] = 0;
            }

            $_SESSION['cart']['total'] += $product->getPrice() * $product->getQuantity();
        }
    }
?>