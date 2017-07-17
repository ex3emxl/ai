<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.zfort.com.ua
 * @since      1.0.0
 *
 * @package    Mimurdubek
 * @subpackage Mimurdubek/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<h2><?php _e( 'Mimurdubek', 'wp_admin_style' ); ?></h2>

<div class="wrap">

    <div id="icon-options-general" class="icon32"></div>

    <div id="poststuff">

        <div id="post-body" class="metabox-holder columns-2">

            <!-- main content -->
            <div id="post-body-content">

                <div class="meta-box-sortables ui-sortable">

                    <div class="postbox">

                        <h2><span><?php esc_attr_e( 'Api Keys', 'wp_admin_style' ); ?></span></h2>

                        <div class="inside">
                            <p><?php esc_attr_e(
                                    'Here you can insert some required API keys.',
                                    'wp_admin_style'
                                ); ?></p>

                            <form method="post" action="options.php">
                                <?php settings_fields( 'mimurdubek_settings' ); ?>
                                <?php do_settings_sections( 'mimurdubek_settings' ); ?>
                                <table class="form-table">
                                    <tr valign="top">
                                        <th scope="row">api_client_token</th>
                                        <td><input type="text" name="api_client_token" value="<?php echo esc_attr( get_option('api_client_token') ); ?>" /></td>
                                    </tr>

                                    <tr valign="top">
                                        <th scope="row">api_dev_token</th>
                                        <td><input type="text" name="api_dev_token" value="<?php echo esc_attr( get_option('api_dev_token') ); ?>" /></td>
                                    </tr>
                                </table>

                                <?php submit_button(); ?>

                            </form>

                        </div>
                        <!-- .inside -->

                    </div>
                    <!-- .postbox -->

                </div>
                <!-- .meta-box-sortables .ui-sortable -->

            </div>
            <!-- post-body-content -->

            <!-- sidebar -->
            <div id="postbox-container-1" class="postbox-container">

                <div class="meta-box-sortables">

                    <div class="postbox">

                        <h2><span><?php esc_attr_e(
                                    'Copyright', 'wp_admin_style'
                                ); ?></span></h2>

                        <div class="inside">
                            <p><?php esc_attr_e(
                                    'Everything you see here, from the documentation to the code itself, was created by and for the community. WordPress is an Open Source project, which means there are hundreds of people all over the world working on it. (More than most commercial platforms.) It also means you are free to use it for anything from your cat’s home page to a Fortune 500 web site without paying anyone a license fee and a number of other important freedoms.',
                                    'wp_admin_style'
                                ); ?></p>
                        </div>
                        <!-- .inside -->

                    </div>
                    <!-- .postbox -->

                </div>
                <!-- .meta-box-sortables -->

            </div>
            <!-- #postbox-container-1 .postbox-container -->

        </div>
        <!-- #post-body .metabox-holder .columns-2 -->

        <br class="clear">
    </div>
    <!-- #poststuff -->

</div> <!-- .wrap -->
