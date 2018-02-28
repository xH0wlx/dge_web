<?php

class GE_FiltersQuery {
    
     public function __construct() {
     }

    /**
     * First create the dropdown
     * make sure to change POST_TYPE to the name of your custom post type
     * 
     * @author Ohad Raz
     * 
     * @return void
     */
    function ge_admin_posts_filter_restrict_manage_posts(){
        $type = 'post';
        if (isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
        }

        //only add filter to post type you want
        if ('ge_funcionarios' == $type){
            //change this to the list of values you want to show
            //in 'label' => 'value' format
            $values = array(
                'Académicos' => 'academicos', 
                'Administrativos' => 'administrativos',
                'Directivos' => 'directivos',
            );
            
            ?>
            <select name="ADMIN_FILTER_FIELD_VALUE">
            <option value=""><?php echo 'Filtrar por Rol'; ?></option>
            <?php
                $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
                foreach ($values as $label => $value) {
                    printf
                        (
                            '<option value="%s"%s>%s</option>',
                            $value,
                            $value == $current_v? ' selected="selected"':'',
                            $label
                        );
                    }
            ?>
            </select>
            <?php
        }
    }


    /**
     * if submitted filter by post meta
     * 
     * make sure to change META_KEY to the actual meta key
     * and POST_TYPE to the name of your custom post type
     * @author Ohad Raz
     * @param  (wp_query object) $query
     * 
     * @return Void
     */
    function ge_posts_filter( $query ){
        global $pagenow;
        $type = 'post';
        if (isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
        }
        if ( 'ge_funcionarios' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '') {
            $query->query_vars['tax_query'] = [
                                                [
                                                    'taxonomy' => 'ge_rol',
                                                    'field'    => 'slug',
                                                    'terms'    => $_GET['ADMIN_FILTER_FIELD_VALUE'],
                                                ]
                                               ];
        }
    }
    
}