<?php
require_once('ge-mb-info-base.php');
require_once('ge-mb-publicaciones-ponencias.php');
require_once('ge-mb-proyectos.php');
require_once('ge-mb-trabajo-actualidad.php');

require_once('ge-mb-descargas-media.php');

abstract class GE_MetaboxCreator{
    
    static function createFuncionariosMetabox($post_type_key){
            GE_MB_InfoBase::add($post_type_key);
            GE_MB_PublicacionesPonencias::add($post_type_key);
            GE_MB_Proyectos::add($post_type_key);
            GE_MB_TrabajoActualidad::add($post_type_key);
    }
    
    static function saveFuncionariosMetabox($post_id, $post, $update){
        GE_MB_InfoBase::save($post_id, $post, $update);
        GE_MB_PublicacionesPonencias::save($post_id, $post, $update);
        GE_MB_Proyectos::save($post_id, $post, $update);
        GE_MB_TrabajoActualidad::save($post_id, $post, $update);
    }
    
    static function createDescargasMetabox($post_type_key){
        GE_MB_DescargaMedia::add($post_type_key);
    }
    
    static function saveDescargasMetabox($post_id, $post, $update){
        GE_MB_DescargaMedia::save($post_id, $post, $update);
    }
}