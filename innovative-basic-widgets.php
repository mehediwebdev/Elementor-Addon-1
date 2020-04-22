<?php
/**
 * Innovative Basic Widgets
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
use \Elementor\Widget_Base;

class Innovative_Basic_Widgets extends Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'innovative_basic_widget';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return __( 'First Widgets', 'innovative-elementor-addons' );
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'fa fa-edit';
	}

	/**
	 * Get widget categories.
	 */
	public function get_categories() {
		return [ 'first-category' ];
	}
    public function get_style_depends(){
		
		return['innovative-widget-custom-css'];
	}
	 public function get_script_depends(){
		
		return['innovative-widget-custom-js'];
	}
	/**
	 * Register oEmbed widget controls.
	 */
	protected function _register_controls() {

     		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

     	$this->add_control(
			'widget_title',
			[
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'plugin-domain' ),
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);
            $this->end_controls_section();

            // Add new control section 
			$this->start_controls_section(
			'text_section',
			[
				'label' => __( 'URL', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'website_link',
			[
				'label' => __( 'Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);


		$this->end_controls_section();

		// Add new Control 
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

     
            $this->end_controls_section();

	}
  

	/**
	 * Render oEmbed widget output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		echo '<h2>' . $settings['widget_title'] . '</h2>';
	}

	protected function _content_template() {
		?>
		<h2>{{{ settings.widget_title }}}</h2>
		<?php
	}

protected function render() {
		$settings = $this->get_settings_for_display();
		$target = $settings['website_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['website_link']['nofollow'] ? ' rel="nofollow"' : '';
		echo '<a href="' . $settings['website_link']['url'] . '"' . $target . $nofollow . '> ... </a>';
	}

	protected function _content_template() {
		?>
		<#
		var target = settings.website_link.is_external ? ' target="_blank"' : '';
		var nofollow = settings.website_link.nofollow ? ' rel="nofollow"' : '';
		#>
		<a href="{{ settings.website_link.url }}"{{ target }}{{ nofollow }}> ... </a>
		<?php
	}



}