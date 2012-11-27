<?php
/** WordPress Administration Bootstrap */
require_once './admin.php';
if ( !current_user_can('edit_posts') )
    wp_die(__('Cheatin&#8217; uh?'));
?>
<div class="wrap">
    <div id="icon-tools" class="icon32 icon32-posts-deprecated_log"><br></div><?php echo "<h2>".__('Iris Color Picker Demo')."</h2>";?>
    <form method="post" action="options.php">
        <?php settings_fields( 'iris_cpdemo_plugin_options' ); ?>
        <?php $options = get_option( 'iris_cpdemo_options' );?>

        <ul>
            <li><label for="link_color"><?php echo __('Link Color'); ?>: </label>
                <input name="iris_cpdemo_options[link_color]" id="link-color" type="text" value="<?php if ( isset( $options['link_color'] ) ) echo $options['link_color']; ?>" />
            </li>
       </ul>

        <?php submit_button();?>
    </form>
</div>
