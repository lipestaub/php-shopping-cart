<?php
    class Product {
        private int $id;
        private string $description;
        private float $price;
        private int $quantity;

        public function getId() {
            return $this->id;
        }

        public function setId(int $id) {
            $this->id = $id;
        }

        public function getDescription() {
            return $this->description;
        }

        public function setDescription(string $description) {
            $this->description = $description;
        }

        public function getPrice() {
            return $this->price;
        }

        public function setPrice(float $price) {
            $this->price = $price;
        }

        public function getQuantity() {
            return $this->quantity;
        }

        public function setQuantity(int $quantity) {
            $this->quantity = $quantity;
        }
    }
?>