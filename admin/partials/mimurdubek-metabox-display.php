<?php wp_nonce_field('-1', 'mimurdubek_metabox_nonce'); ?>

<?php foreach (self::$meta_fields as $slug => $label): ?>

    <?php $meta_value = get_post_meta($object->ID, '_' . $slug); ?>
    <p>
        <label for="<?php echo $slug; ?>"><?php echo $label; ?></label>
        <input
                type="text"
                id="<?php echo $slug; ?>"
                name="<?php echo $slug; ?>"
                value="<?php echo (!empty($meta_value)) ? $meta_value[0] : ''; ?>"
        />
    </p>
<?php endforeach; ?>