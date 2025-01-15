# ACF Feather Icon Field

A custom field type for Advanced Custom Fields (ACF) Pro that adds a Feather Icon picker. This field allows you to easily select from the complete collection of [Feather Icons](https://feathericons.com/) in your WordPress admin.

## Features

- Beautiful and user-friendly icon picker interface
- Search functionality to quickly find icons
- Category filtering to browse icons by type
- Returns either HTML markup or icon class name
- Fully responsive design
- Compatible with the latest WordPress and ACF Pro versions

## Requirements

- WordPress 5.0 or later
- Advanced Custom Fields PRO 5.0.0 or later
- PHP 7.0 or later

## Installation

1. Download the plugin
2. Upload the plugin files to the `/wp-content/plugins/acf-feather-icon-field` directory
3. Activate the plugin through the 'Plugins' screen in WordPress
4. The field type will now be available in ACF field group settings as "Feather Icon"

## Usage

1. Create a new field group in ACF
2. Add a new field and select "Feather Icon" as the field type
3. Configure the field settings:
   - Return Format: Choose between "Icon HTML" or "Icon Class"
   - Icon HTML returns: `<i data-feather="icon-name"></i>`
   - Icon Class returns: `feather-icon-name`

### Using the Icon in Your Theme

When using the "Icon HTML" return format, make sure to include the Feather Icons JavaScript in your theme:

```html
<script src="https://unpkg.com/feather-icons"></script>
<script>
  feather.replace();
</script>
```

### Example Usage in PHP

```php
<?php
// Get the icon
$icon = get_field('your_field_name');

if ($icon) {
    // If return format is "Icon HTML"
    echo $icon;
    
    // If return format is "Icon Class"
    echo '<i class="' . esc_attr($icon) . '"></i>';
}
?>
```

## License

This project is licensed under the GPL v2 or later - see the [LICENSE](LICENSE) file for details.

## Credits

- [Feather Icons](https://feathericons.com/) - Beautiful open source icons
- [Advanced Custom Fields](https://www.advancedcustomfields.com/) - The best custom fields plugin for WordPress 