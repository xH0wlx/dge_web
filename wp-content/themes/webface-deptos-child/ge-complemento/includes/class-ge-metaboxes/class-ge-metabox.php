<?php

/**
 * @since      1.0.0
 * @package    gestion-empresarial
 * @subpackage gestion-empresarial/includes
 * @author     Luis Muñoz <luis.m.munoz.j@gmail.com>
 */
abstract class GE_Metabox {
    
    abstract public static function add($post_type_key);

    abstract public static function html($post, $metabox);
    
    abstract public static function save($post_id, $post, $update);
    
}
