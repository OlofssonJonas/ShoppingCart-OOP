<?php

class Cart
{
    private array $items = [];
    
    //TODO Skriv getter för items
    
    public function getItems() {
        return $this -> items;
    }
    
    /*
    Skall lägga till en produkt i kundvagnen genom att
    skapa ett nytt cartItem och lägga till i $items array.
    Metoden skall returnera detta cartItem.
    
    VG: Om produkten redan finns i kundvagnen
    skall istället quantity på cartitem ökas.
    */
    
    public function addProduct($product)
    {
        //spara Id på produkten. den kan vi återanvända
        $id = $product->getId();

        // vi kollar om getID finns i vår array. (omgjort till variabel)
        if (isset($this->items[$id])) {
            $this->items[$id]->increaseQuantity();
        } else {
            $CartItem = new CartItem($product, 1);
            $this->items[$product->getId()] = $CartItem;

            return $CartItem;
        }
    }

        //Skall ta bort en produkt ur kundvagnen (använd unset())
        public function removeProduct($product)
        {
            unset($this->items[$product->getId()]);
            
        }
        
        //Skall returnera totala antalet produkter i kundvagnen
        //OBS: Ej antalet unika produkter
        public function getTotalQuantity()
        {
            $totQuantity = 0;
            
            foreach($this -> items as $item) {
                $totQuantity += $item -> getQuantity();
                
            }
            return $totQuantity;
        }
        
        //Skall räkna ihop totalsumman för alla produkter i kundvagnen
        //VG: Tänk på att ett cartitem kan ha olika quantity
        public function getTotalSum() {
            
            $totSum = 0;
            
            foreach($this -> items as $item) {
                $totSum += $item -> getQuantity() * $item -> getProduct() -> getPrice();
                
            }
            return $totSum;
        }
    }
        
    