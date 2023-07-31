<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSeparator extends Model
{
    use HasFactory;

    private $name;
    private $price;
    private $quantity;

    public function __construct($rawInput) {
        // Dividir la cadena de entrada utilizando el patrón "$$ ##"
        list($this->name, $price, $quantity) = explode('$$ ##', $rawInput);

        // Asignar los valores a los atributos de clase
        $this->name = trim($this->name);
        $this->price = (double) trim($price);
        $this->quantity = (int) trim($quantity);
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    // Agregado método para obtener la cadena de entrada original
    public function getRawInput() {
        return $this->name . " $$ ##" . $this->price . " $$ ##" . $this->quantity;
    }

}
