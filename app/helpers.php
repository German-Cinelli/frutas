<?php

/**
 * Método para formatear un integer
 * Si se recibe: 480 //->output $ 480.00
 */
function priceFormat($price){

    return sprintf('$ %s', number_format($price, 2));

}

function datatable_arrow($direction){
    if($direction == 'desc'){
        echo '<i class="fa fa-caret-down"></i>';
    } else {
        echo ' <i class="fa fa-caret-up"></i>';
    }
}


/**
 * Método que a partir de un item_id devuelve el nombre del producto
 */
function getProduct_name($item_id){
    return \App\OrderProduct::find($item_id)->product->name;
}


/**
 * Funcion que recibe por parametro el ID de un pedido
 * Y devuelve el débito
 */
function debito($order_id){
    $deb = \App\Payment::where('order_id', $order_id)->latest()->first();
    if($deb == null){
        return null;
    } else {
        return $deb->debito;
    }
}