<?php

/**
 * Defines the custom field type class.
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * acf_field_s_tier_icons class.
 */
class acf_field_s_tier_icons extends \acf_field
{
	/**
	 * Controls field type visibilty in REST requests.
	 *
	 * @var bool
	 */
	public $show_in_rest = true;

	/**
	 * Environment values relating to the theme or plugin.
	 *
	 * @var array $env Plugin or theme context such as 'url' and 'version'.
	 */
	private $env;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		/**
		 * Field type reference used in PHP and JS code.
		 *
		 * No spaces. Underscores allowed.
		 */
		$this->name = 's_tier_icons';

		/**
		 * Field type label.
		 *
		 * For public-facing UI. May contain spaces.
		 */
		$this->label = __('S Tier Icons', 'stier');

		/**
		 * The category the field appears within in the field type picker.
		 */
		$this->category = 'basic'; // basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME

		/**
		 * Field type Description.
		 *
		 * For field descriptions. May contain spaces.
		 */
		$this->description = __('Custom Icons Field', 'stier');

		/**
		 * Field type Doc URL.
		 *
		 * For linking to a documentation page. Displayed in the field picker modal.
		 */
		$this->doc_url = '';

		/**
		 * Field type Tutorial URL.
		 *
		 * For linking to a tutorial resource. Displayed in the field picker modal.
		 */
		$this->tutorial_url = '';

		/**
		 * Defaults for your custom user-facing settings for this field type.
		 */
		$this->defaults = array(
			'font_size'	=> 14,
		);

		/**
		 * Strings used in JavaScript code.
		 *
		 * Allows JS strings to be translated in PHP and loaded in JS via:
		 *
		 * ```js
		 * const errorMessage = acf._e("s_tier_icons", "error");
		 * ```
		 */
		$this->l10n = array(
			'error'	=> __('Error! Please enter a higher value', 'stier'),
		);

		$this->env = array(
			'url'     => site_url(str_replace(ABSPATH, '', __DIR__)), // URL to the acf-s-tier-icons directory.
			'version' => '1.0', // Replace this with your theme or plugin version constant.
		);

		/**
		 * Field type preview image.
		 *
		 * A preview image for the field type in the picker modal.
		 */
		$this->preview_image = $this->env['url'] . '/assets/images/field-preview-custom.png';

		parent::__construct();

		add_filter('format_value', [$this, 'format_value'], 10, 3);
	}

	/**
	 * Settings to display when users configure a field of this type.
	 *
	 * These settings appear on the ACF “Edit Field Group” admin page when
	 * setting up the field.
	 *
	 * @param array $field
	 * @return void
	 */
	public function render_field_settings($field)
	{

	}

	private function read_svg_file($file_path) {
		$svg_content = "";

		if(file_exists($file_path)) {
			$svg = $myfile = fopen($file_path, "r");
			$svg_content = fread($myfile,filesize($file_path));
			fclose($svg);
		}

		return $svg_content;
	}

	public function format_value($value, $post_id, $field)
	{

		// Check if the field type matches your custom field type

		if ($field['type'] === 's_tier_icons') {

			$icon_path = get_attached_file($value);
			$svg_content = $this->read_svg_file($icon_path);

			if($svg_content) {
				$value = $svg_content;
			}
		}

		// Return the modified value

		return $value;
	}

	/**
	 * HTML content to show when a publisher edits the field on the edit screen.
	 *
	 * @param array $field The field settings and values.
	 * @return void
	 */
	public function render_field($field)
	{
		$icons = get_field('theme_icons', 'options');
?>
		<div class="s-tier-icons">
			<div class="s-tier-icons__inner">
				<?php
				if ($icons) :
					foreach ($icons as $icon) :
						$icon_path = get_attached_file($icon);
						$svg = $this->read_svg_file($icon_path);
						if (!$svg) continue;
				?>
						<div class="s-tier-icons__item">
							<input  <?php if ($field['value'] == $icon) echo 'checked=checked'; ?> id="<?php echo $icon; ?>" name="<?php echo esc_attr($field['name']) ?>" value="<?php echo $icon ?>" type="radio">
							<label class="s-tier-icons__item-label  <?php if ($field['value'] == $icon) echo 'active'; ?>" for="<?php echo $icon; ?>"><?php echo $svg; ?></label>
						</div>
					<?php
					endforeach;
					?>

				<?php else : ?>

					<p class="no-icons">Add icons from site settings.</p>
				<?php endif; ?>

			</div>
		</div>

<?php


	}

	/**
	 * Enqueues CSS and JavaScript needed by HTML in the render_field() method.
	 *
	 * Callback for admin_enqueue_script.
	 *
	 * @return void
	 */
	public function input_admin_enqueue_scripts()
	{
		$url     = get_template_directory_uri() . '/includes/theme-icons/';
		$version = $this->env['version'];


		wp_register_script(
			's-tier-icons',
			"{$url}assets/js/field.js",
			array('acf-input'),
			$version
		);

		wp_register_style(
			's-tier-icons',
			"{$url}assets/css/field.css",
			array('acf-input'),
			$version
		);

		wp_enqueue_script('s-tier-icons');
		wp_enqueue_style('s-tier-icons');
	}
}
