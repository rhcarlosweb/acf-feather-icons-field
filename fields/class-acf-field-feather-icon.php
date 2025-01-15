<?php
/**
 * Create a new Feather Icon field type for ACF
 */
class acf_field_feather_icon extends acf_field {

    /**
     * Initialize the field
     */
    function __construct() {
        $this->name = 'feather_icon';
        $this->label = __('Feather Icon', 'acf-feather-icon');
        $this->category = 'choice';
        $this->defaults = array(
            'default_value' => '',
            'return_format' => 'icon'  // Options: 'icon' or 'class'
        );

        parent::__construct();
    }

    /**
     * Render field settings
     */
    function render_field_settings($field) {
        acf_render_field_setting($field, array(
            'label'         => __('Return Format', 'acf-feather-icon'),
            'instructions'  => __('Specify the returned value on front end', 'acf-feather-icon'),
            'type'         => 'radio',
            'name'         => 'return_format',
            'layout'       => 'horizontal',
            'choices'      => array(
                'icon'  => __('Icon HTML', 'acf-feather-icon'),
                'class' => __('Icon Class', 'acf-feather-icon')
            )
        ));
    }

    /**
     * Render field input
     */
    function render_field($field) {
        // Get current value
        $value = esc_attr($field['value']);

        // Create unique ID
        $field_id = esc_attr($field['id']);

        // Icons array - add all icons you want to use
        $icons = array(
            'activity', 'airplay', 'alert-circle', 'alert-octagon', 'alert-triangle',
            'align-center', 'align-justify', 'align-left', 'align-right',
            'anchor', 'aperture', 'archive', 'arrow-down-circle', 'arrow-down-left',
            'arrow-down-right', 'arrow-down', 'arrow-left-circle', 'arrow-left',
            'arrow-right-circle', 'arrow-right', 'arrow-up-circle', 'arrow-up-left',
            'arrow-up-right', 'arrow-up', 'at-sign', 'award', 'bar-chart-2',
            'bar-chart', 'battery-charging', 'battery', 'bell-off', 'bell',
            'bluetooth', 'bold', 'book-open', 'book', 'bookmark', 'box',
            'briefcase', 'calendar', 'camera-off', 'camera', 'cast', 'check-circle',
            'check-square', 'check', 'chevron-down', 'chevron-left', 'chevron-right',
            'chevron-up', 'chevrons-down', 'chevrons-left', 'chevrons-right',
            'chevrons-up', 'chrome', 'circle', 'clipboard', 'clock', 'cloud-drizzle',
            'cloud-lightning', 'cloud-off', 'cloud-rain', 'cloud-snow', 'cloud',
            'code', 'codepen', 'codesandbox', 'coffee', 'columns', 'command',
            'compass', 'copy', 'corner-down-left', 'corner-down-right',
            'corner-left-down', 'corner-left-up', 'corner-right-down',
            'corner-right-up', 'corner-up-left', 'corner-up-right', 'cpu', 'credit-card',
            'crop', 'crosshair', 'database', 'delete', 'disc', 'divide-circle',
            'divide-square', 'divide', 'dollar-sign', 'download-cloud', 'download',
            'dribbble', 'droplet', 'edit-2', 'edit-3', 'edit', 'external-link',
            'eye-off', 'eye', 'facebook', 'fast-forward', 'feather', 'figma',
            'file-minus', 'file-plus', 'file-text', 'file', 'film', 'filter',
            'flag', 'folder-minus', 'folder-plus', 'folder', 'framer', 'frown',
            'gift', 'git-branch', 'git-commit', 'git-merge', 'git-pull-request',
            'github', 'gitlab', 'globe', 'grid', 'hard-drive', 'hash', 'headphones',
            'heart', 'help-circle', 'hexagon', 'home', 'image', 'inbox', 'info',
            'instagram', 'italic', 'key', 'layers', 'layout', 'life-buoy', 'link-2',
            'link', 'linkedin', 'list', 'loader', 'lock', 'log-in', 'log-out',
            'mail', 'map-pin', 'map', 'maximize-2', 'maximize', 'meh', 'menu',
            'message-circle', 'message-square', 'mic-off', 'mic', 'minimize-2',
            'minimize', 'minus-circle', 'minus-square', 'minus', 'monitor',
            'moon', 'more-horizontal', 'more-vertical', 'mouse-pointer', 'move',
            'music', 'navigation-2', 'navigation', 'octagon', 'package',
            'paperclip', 'pause-circle', 'pause', 'pen-tool', 'percent', 'phone-call',
            'phone-forwarded', 'phone-incoming', 'phone-missed', 'phone-off',
            'phone-outgoing', 'phone', 'pie-chart', 'play-circle', 'play',
            'plus-circle', 'plus-square', 'plus', 'pocket', 'power', 'printer',
            'radio', 'refresh-ccw', 'refresh-cw', 'repeat', 'rewind', 'rotate-ccw',
            'rotate-cw', 'rss', 'save', 'scissors', 'search', 'send', 'server',
            'settings', 'share-2', 'share', 'shield-off', 'shield', 'shopping-bag',
            'shopping-cart', 'shuffle', 'sidebar', 'skip-back', 'skip-forward',
            'slack', 'slash', 'sliders', 'smartphone', 'smile', 'speaker', 'square',
            'star', 'stop-circle', 'sun', 'sunrise', 'sunset', 'tablet', 'tag',
            'target', 'terminal', 'thermometer', 'thumbs-down', 'thumbs-up',
            'toggle-left', 'toggle-right', 'tool', 'trash-2', 'trash', 'trello',
            'trending-down', 'trending-up', 'triangle', 'truck', 'tv', 'twitch',
            'twitter', 'type', 'umbrella', 'underline', 'unlock', 'upload-cloud',
            'upload', 'user-check', 'user-minus', 'user-plus', 'user-x', 'user',
            'users', 'video-off', 'video', 'voicemail', 'volume-1', 'volume-2',
            'volume-x', 'volume', 'watch', 'wifi-off', 'wifi', 'wind', 'x-circle',
            'x-octagon', 'x-square', 'x', 'youtube', 'zap-off', 'zap', 'zoom-in',
            'zoom-out'
        );

        // Add icon categories array before the icons array
        $icon_categories = array(
            'arrows' => array('arrow-down', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down-circle', 'arrow-left-circle', 'arrow-right-circle', 'arrow-up-circle', 'arrow-down-left', 'arrow-down-right', 'arrow-up-left', 'arrow-up-right', 'chevron-down', 'chevron-left', 'chevron-right', 'chevron-up', 'chevrons-down', 'chevrons-left', 'chevrons-right', 'chevrons-up'),
            'media' => array('play', 'pause', 'play-circle', 'pause-circle', 'stop-circle', 'volume', 'volume-1', 'volume-2', 'volume-x', 'video', 'video-off', 'image', 'music', 'film'),
            'social' => array('facebook', 'twitter', 'instagram', 'linkedin', 'github', 'gitlab', 'youtube', 'twitch', 'dribbble', 'codepen', 'codesandbox', 'slack'),
            'interface' => array('home', 'settings', 'menu', 'grid', 'search', 'filter', 'plus', 'minus', 'x', 'check', 'alert-circle', 'info', 'help-circle'),
            'devices' => array('smartphone', 'tablet', 'monitor', 'tv', 'battery', 'wifi', 'bluetooth', 'hard-drive', 'cpu', 'server'),
            'other' => array() // Will be filled with uncategorized icons
        );

        // Categorize remaining icons
        foreach ($icons as $icon) {
            $categorized = false;
            foreach ($icon_categories as $category => $category_icons) {
                if (in_array($icon, $category_icons)) {
                    $categorized = true;
                    break;
                }
            }
            if (!$categorized) {
                $icon_categories['other'][] = $icon;
            }
        }

        // Begin HTML
        ?>
        <div class="acf-feather-icon-picker <?php echo $value ? 'has-value' : ''; ?>">
            <div class="icon-selector-button-container">
                <button type="button" class="icon-selector-button" title="<?php esc_attr_e('Choose Icon', 'acf-feather-icon') ?>">
                    <?php if($value): ?>
                        <i data-feather="<?php echo $value ?>"></i>
                    <?php else: ?>
                        <span class="no-icon-text"><?php esc_html_e('Select an icon', 'acf-feather-icon'); ?></span>
                    <?php endif; ?>
                </button>
                <span class="clear-icon-button" title="<?php esc_attr_e('Clear Icon', 'acf-feather-icon') ?>">×</span>
            </div>

            <div class="icon-picker-modal" style="display:none;">
                <div class="icon-picker-header">
                    <div class="filter-controls">
                        <input type="text" class="icon-search" placeholder="<?php esc_attr_e('Search icons...', 'acf-feather-icon') ?>">
                        <select class="icon-category-filter">
                            <option value="all"><?php esc_html_e('All Categories', 'acf-feather-icon') ?></option>
                            <?php foreach ($icon_categories as $category => $category_icons): ?>
                                <option value="<?php echo esc_attr($category) ?>">
                                    <?php echo esc_html(ucfirst($category)) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="button" class="close-modal">×</button>
                </div>

                <div class="icon-picker-grid">
                    <?php foreach ($icons as $icon): 
                        $icon_category = 'other';
                        foreach ($icon_categories as $category => $category_icons) {
                            if (in_array($icon, $category_icons)) {
                                $icon_category = $category;
                                break;
                            }
                        }
                    ?>
                        <div class="icon-item <?php echo $value === $icon ? 'selected' : ''; ?>"
                             data-icon="<?php echo esc_attr($icon) ?>"
                             data-category="<?php echo esc_attr($icon_category) ?>">
                            <i data-feather="<?php echo esc_attr($icon) ?>"></i>
                            <span class="icon-name"><?php echo esc_html($icon) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <input type="hidden" name="<?php echo esc_attr($field['name']) ?>"
                   value="<?php echo esc_attr($value) ?>" />
        </div>
        <?php
    }

    /**
     * Format value for frontend
     */
    function format_value($value, $post_id, $field) {
        if(empty($value)) {
            return '';
        }

        // Return format
        if($field['return_format'] === 'class') {
            return 'feather-' . $value;
        }

        return '<i data-feather="' . esc_attr($value) . '"></i>';
    }

    /**
     * Load assets
     */
    function input_admin_enqueue_scripts() {
        // Register and enqueue Feather Icons
        wp_enqueue_script(
            'feather-icons-js',
            'https://unpkg.com/feather-icons',
            array('jquery'),
            '4.29.0',
            true
        );

        // Register and enqueue our custom CSS
        wp_enqueue_style(
            'acf-feather-icon',
            plugin_dir_url(dirname(__FILE__)) . 'assets/css/acf-feather-icon.css',
            array('acf-input'),
            '1.0.0'
        );

        // Register and enqueue our custom JS
        wp_enqueue_script(
            'acf-feather-icon',
            plugin_dir_url(dirname(__FILE__)) . 'assets/js/acf-feather-icon.js',
            array('jquery', 'feather-icons-js'),
            '1.0.0',
            true
        );

        // Localize the script with translation strings
        wp_localize_script('acf-feather-icon', 'acf_feather_icon', array(
            'i18n' => array(
                'select_icon' => __('Select an icon', 'acf-feather-icon'),
                'choose_icon' => __('Choose Icon', 'acf-feather-icon'),
                'clear_icon' => __('Clear Icon', 'acf-feather-icon'),
                'search_icons' => __('Search icons...', 'acf-feather-icon'),
                'all_categories' => __('All Categories', 'acf-feather-icon')
            )
        ));
    }
}

// Initialize
acf_register_field_type('acf_field_feather_icon');
