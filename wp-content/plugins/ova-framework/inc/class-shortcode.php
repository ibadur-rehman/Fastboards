<?php if (!defined( 'ABSPATH' )) exit;

if( !class_exists('Remons_Shortcode') ){
    
    class Remons_Shortcode {

        public function __construct() {

            add_shortcode( 'remons-elementor-template', array( $this, 'remons_elementor_template' ) );
            
        }

        public function remons_elementor_template( $atts ){

            $atts = extract( shortcode_atts(
            array(
                'id'  => '',
            ), $atts) );

            $args = array(
                'id' => $id
                
            );

            if( did_action( 'elementor/loaded' ) ){
                return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id );    
            }
            return;

            
        }

        

    }
}



return new Remons_Shortcode();

