<?php
/**
 * Sanitize functions
 *
 * @package Sydney
 */


/**
 * Selects
 */
function sydney_sanitize_select( $input, $setting ){
          
    $input = sanitize_key($input);

    $choices = $setting->manager->get_control( $setting->id )->choices;
                      
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
}

/**
 * Sanitize radio images
 *
 * Like sydney_sanitize_select(), and also rejects the locked Pro choices.
 */
function sydney_sanitize_radio_images( $input, $setting ) {

    $input = sanitize_key( $input );

    $choices = $setting->manager->get_control( $setting->id )->choices;

    if ( ! array_key_exists( $input, $choices ) || ! empty( $choices[ $input ]['is_pro'] ) ) {
        return $setting->default;
    }

    return $input;
}

/**
 * Sanitize blog elements
 *
 * The allowed list is the free edition's; Pro widens it with the three
 * elements only its templates render.
 */
function sydney_sanitize_blog_meta_elements( $input ) {
	$input     = (array) $input;
	$sanitized = array();
	$allowed   = array( 'post_date', 'post_categories', 'post_author', 'post_comments', 'post_tags' );

	if ( sydney_is_pro() ) {
		$allowed = array_merge( $allowed, array( 'reading_time', 'updated_date', 'custom_field' ) );
	}

	foreach ( $input as $sub_value ) {
		if ( in_array( $sub_value, $allowed, true ) ) {
			$sanitized[] = $sub_value;
		}
	}

	return $sanitized;
}

/**
 * Sanitize single post elements
 *
 * The allowed list is the free edition's; Pro widens it with the three
 * elements only its templates render.
 */
function sydney_sanitize_single_meta_elements( $input ) {
	$input     = (array) $input;
	$sanitized = array();
	$allowed   = array( 'sydney_posted_on', 'sydney_posted_by', 'sydney_post_categories', 'sydney_entry_comments' );

	if ( sydney_is_pro() ) {
		$allowed = array_merge( $allowed, array( 'sydney_reading_time', 'sydney_updated_date', 'sydney_meta_custom_field' ) );
	}

	foreach ( $input as $sub_value ) {
		if ( in_array( $sub_value, $allowed, true ) ) {
			$sanitized[] = $sub_value;
		}
	}

	return $sanitized;
}

/**
 * Sanitize single post sharing networks
 */
function sydney_sanitize_single_sharing_networks( $input ) {
    $input     = (array) $input;
    $sanitized = array();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, array( 'threads', 'mastodon', 'bluesky', 'facebook', 'twitter', 'linkedin', 'pinterest', 'whatsapp', 'telegram', 'vk', 'weibo', 'reddit', 'ok', 'xing', 'mail' ), true ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;
}

/**
 * Sanitize header components
 */
function sydney_sanitize_header_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( sydney_header_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements, true ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize loop product components
 */
function sydney_sanitize_product_loop_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array( 'woocommerce_template_loop_product_title', 'woocommerce_template_loop_rating', 'woocommerce_template_loop_price', 'sydney_loop_product_category', 'sydney_loop_product_description' );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements, true ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}


/**
 * Sanitize top bar components
 */
function sydney_sanitize_topbar_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( sydney_topbar_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements, true ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize footer copyright components
 */
function sydney_sanitize_footer_copyright_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( sydney_footer_copyright_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements, true ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;       
}

/**
 * Sanitize text
 */
function sydney_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Validate phone number
 * 
 * Checks if input contains only valid phone number characters.
 * 
 * @param WP_Error $validity The validity object.
 * @param string   $value    The value to validate.
 * @return WP_Error The validity object with any errors added.
 */
function sydney_validate_phone_number( $validity, $value ) {
    // Remove all characters except digits, +, -, spaces, and parentheses
    $sanitized = preg_replace( '/[^0-9+\-\s()]/', '', $value );
    
    // If sanitized value is different, it means invalid characters were found
    if ( $sanitized !== $value ) {
        $validity->add( 'invalid_phone_characters', esc_html__( 'Invalid characters. Only numbers, +, -, spaces, and parentheses are allowed.', 'sydney' ) );
    }
    
    return $validity;
}


/**
 * Sanitize URLs
 */
function sydney_sanitize_urls( $input ) {
    if ( strpos( $input, ',' ) !== false) {
        $input = explode( ',', $input );
    }
    if ( is_array( $input ) ) {
        foreach ($input as $key => $value) {
            $input[$key] = esc_url_raw( $value );
        }
        $input = implode( ',', $input );
    }
    else {
        $input = esc_url_raw( $input );
    }
    return $input;
}

/**
 * Sanitize hex and rgba
 */
function sydney_sanitize_hex_rgba( $input, $setting ) {
    if ( empty( $input ) || is_array( $input ) ) {
        return $setting->default;
    }

    if ( false === strpos( $input, 'rgb' ) ) {
        $input = sanitize_hex_color( $input );
    } elseif ( false === strpos( $input, 'rgba' ) ) {
            // Sanitize as RGB color
            $input = str_replace( ' ', '', $input );
            sscanf( $input, 'rgb(%d,%d,%d)', $red, $green, $blue );
            $input = 'rgb(' . sydney_in_range( $red, 0, 255 ) . ',' . sydney_in_range( $green, 0, 255 ) . ',' . sydney_in_range( $blue, 0, 255 ) . ')';
        }
        else {
            // Sanitize as RGBa color
            $input = str_replace( ' ', '', $input );
            sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
            $input = 'rgba(' . sydney_in_range( $red, 0, 255 ) . ',' . sydney_in_range( $green, 0, 255 ) . ',' . sydney_in_range( $blue, 0, 255 ) . ',' . sydney_in_range( $alpha, 0, 1 ) . ')';
    }
    return $input;
}

/**
 * Helper function to check if value is in range
 */
function sydney_in_range( $input, $min, $max ){
    if ( $input < $min ) {
        $input = $min;
    }
    if ( $input > $max ) {
        $input = $max;
    }
    return $input;
}

/**
 * Sanitize a typography theme_mod (font, regularweight, optional extraweights, category).
 *
 * Scalar fields are passed through sanitize_text_field(). The optional
 * `extraweights` field is treated as an array of weight strings: each entry is
 * coerced to a string, sanitised, dropped if empty, and the final array is
 * deduplicated. Numerically reindexed so `wp_json_encode()` always emits a JSON
 * array (not an object).
 */
function sydney_google_fonts_sanitize( $input ) {
    $val = json_decode( $input, true );
    if ( is_array( $val ) ) {
        foreach ( $val as $key => $value ) {
            if ( is_array( $value ) ) {
                $sanitised = array();
                foreach ( $value as $item ) {
                    $item = sanitize_text_field( (string) $item );
                    if ( '' === $item ) {
                        continue;
                    }
                    $sanitised[] = $item;
                }
                $val[ $key ] = array_values( array_unique( $sanitised ) );
            } else {
                $val[ $key ] = sanitize_text_field( $value );
            }
        }
        $input = wp_json_encode( $val );
    } else {
        // Not parseable as the font object. Encoding the scalar here used to
        // store `""`, which decodes to a string, and every reader indexes the
        // result: on PHP 8 that is a TypeError, not a notice. Fall back to the
        // System default sentinel, which is the shape all readers expect.
        $input = wp_json_encode(
            array(
                'font'          => 'System default',
                'regularweight' => 'regular',
                'category'      => 'sans-serif',
            )
        );
    }
    return $input;
}

/**
 * Sanitize post ids array
 */
function sydney_sanitize_post_array( $input ) {
    $input     = (array) $input;
    
    $sanitized = array_map( 'absint', $input );

    return $sanitized;
}

/**
 * Sanitize quick links
 */
function sydney_sanitize_quick_links( $input ) {
	$input_decoded = json_decode( $input, true );
	if ( ! empty( $input_decoded ) ) {
		foreach ( $input_decoded as $boxk => $box ) {
			foreach ( $box as $key => $value ) {
				$input_decoded[ $boxk ][ $key ] = wp_kses_post( force_balance_tags( $value ) );
			}
		}
		return wp_json_encode( $input_decoded );
	}
	return $input;
}

/**
 * Sanitize single product sitcky add to cart elements
 */
function sydney_sanitize_single_add_to_cart_elements( $input ) {
    $input     = (array) $input;
    $sanitized = array();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, array( 'sydney_sticky_add_to_cart_product_image', 'sydney_sticky_add_to_cart_product_title', 'sydney_single_product_price', 'sydney_sticky_add_to_cart_product_addtocart' ), true ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;
}

/**
 * Sanitize single product components
 */
function sydney_sanitize_single_product_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( sydney_single_product_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements, true ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize Multiple checkbox values.
 */
function sydney_sanitize_multiple_checkbox( $values ) {

	$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/**
 * Select2
 */
function sydney_sanitize_select2( $input, $setting ){        
    if( empty( $input ) ) {
        return '';
    }

    $input   = strpos( $input, ',' ) !== FALSE ? explode( ',', $input ) : array( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;

    foreach( $input as $key => $value ) {
        $input[ $key ] = sanitize_key( $value );

        if( ! array_key_exists( $input[ $key ], $choices ) ) {
            return $setting->default;
        }
    }

    return implode( ',', $input );
}

/**
 * Number
 *
 * The HTML Designer's two heading-margin sliders store em values with a 0.05
 * step, so absint() - what every other slider in that file uses - would round
 * them away.
 */
function sydney_sanitize_number( $input, $setting ) {
    if ( ! is_numeric( $input ) ) {
        return $setting->default;
    }

    return $input + 0;
}
